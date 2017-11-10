import json
from subprocess import call
import shlex
import pexpect
import os
from pexpect import pxssh


#ROOT = '/root/Auto-dist'
ROOT = '/Users/khalil/Documents/Auto-deploy-API/projects/'


class AutoDeployManager:
    def __init__(self):
        pass

    def runLocalCommond(self, commond):
        print("Running: " + commond)
        call(shlex.split(commond))

    def pullRepo(self, git_json):
        os.chdir(ROOT)
        mapping = self.db.getAllRepo()
        repo_name = git_json['repository']['full_name']
        localPath = mapping[repo_name]['localPath']
        branch = git_json['ref'].split("/")[-1]
        # First pull locally
        os.chdir(ROOT + '/' + localPath)

        #os.chdir(ROOT)
        # Then push
        servers = mapping[repo_name]['servers']
        for i in servers:
            if branch == i['branch'] and not i['deleted']:
                self.doPull(i)
        print('Successfully push to all remote')
        return

    def doPull(self, server):
        '''
        if localPath:
            os.chdir(ROOT + '/' + localPath)
        '''
        # Switch branch locally
        #commond = 'git stash && git pull origin ' + server['branch'] + ' -f'
        self.runLocalCommond('git checkout -f ' + server['branch'])
        self.runLocalCommond('git reset --hard origin/' + server['branch'])
        self.runLocalCommond('git pull origin ' + server['branch'])

        commond = "git push " + server['name'] + " " + server['branch']
        print("Running " + commond)

        child = pexpect.spawn(commond)
        child.sendline(commond)
        child.expect(server['user'])
        child.sendline(server['password'])
        output = str(child.read()).replace('\\n', '')
        for o in output.split('\\r'):
            print(o.strip())
        print("================================")

    # Add server
    def addGitRemote(self, server):
        commond = 'git remote add ' + server['name'] + ' ' + server['user'] + '@' + server["ip"] + ":" + server['path']
        self.runLocalCommond(commond)

    def sendCommond(self, pxssh, commond):
        pxssh.sendline(commond)
        pxssh.prompt()
        print(pxssh.before)

    def getPostReceiveContent(self, config):
        text = "'#!/bin/bash \n while \nread oldrev newrev ref \ndo if [[ $ref =~ .*/" + config['branch'] + "$ ]]; \nthen \ngit --work-tree=/root/" + config['path'] + ' --git-dir=/root/' + config['path'] + " checkout -f " + config['branch']  + " \nfi \ndone'"
        return text

    def getPostCheckoutContent(self, config):
        text = 'echo "Done customization"'
        return text

    def configServer(self, config ,repo_name):
        ip = config['ip']
        user = config['user']
        password = config['password']
        path = config['path']
        deploy_path = config['deploy_path']

        # ignore ssh key confirm
        # call(shlex.split('ssh-keyscan ' + ip + ' >> ~/.ssh/known_hosts'))
        POST_RECIEVE_FILE = 'http://khalil.one/ok/post-receive'
        POST_CHECKOUT_FILE = 'http://khalil.one/ok/post-checkout'

        try:
            s = pxssh.pxssh()
            s.login(ip, user, password)
            self.sendCommond(s, 'mkdir ' + path + ' && cd ~/' + path + ' && git init --bare')
            self.sendCommond(s, 'cd hooks && rm * -R')
            #self.sendCommond(s, 'wget ' + POST_RECIEVE_FILE + ' && chmod +x post-receive')
            #self.sendCommond(s, 'wget ' + POST_CHECKOUT_FILE + ' && chmod +x post-checkout')
            self.sendCommond(s, 'echo ' + self.getPostReceiveContent(config) + ' > post-receive && chmod +x post-receive')
            self.sendCommond(s, 'echo ' + self.getPostCheckoutContent(config) + ' > post-checkout && chmod +x post-checkout')

            s.logout()
        except pxssh.ExceptionPxssh as e:
            print("pxssh failed on login.")
            print(e)
            return False

        return True

    def addServer(self, repoName, repoId, serverName, serverIP, serverUser, serverPassword, serverPath, deployPath, branch):
        new_server = {
            "name": serverName,
            "ip": serverIP,
            "user": serverUser,
            "password": serverPassword,
            "path": serverPath,
            "deploy_path": deployPath,
            "branch": branch,
            'deleted': False
          }
        # Login to server and config
        localPath = repoName
        if self.configServer(new_server, repoName):
            # if setup succ, do add remote and pull
            os.chdir(ROOT + localPath)
            self.addGitRemote(new_server)
            self.doPull(new_server)
        else:
            return {"ev_error": 1, "ev_message": "Failed to configure server"}
        os.chdir(ROOT)
        return {"ev_error": 0}

    # Init proj
    def initProj(self, git_url):
        os.chdir(ROOT)
        git_url = git_url.strip("/")
        user = git_url.split('/')[-2]
        proj_name = git_url.split('/')[-1]
        full_name = user + '/' + proj_name
        if not os.path.isdir(user) and not os.path.isdir(full_name):
            commond = 'mkdir ' + user
            self.runLocalCommond(commond)
        else:
            return {"ev_error": 1, "ev_message": "Directory exist"}
        os.chdir(user)
        commond = 'git clone ' + git_url
        self.runLocalCommond(commond)
        os.chdir(ROOT)
        return {"ev_error": 0, "ev_data": full_name}

#a = AutoDeployManager()
