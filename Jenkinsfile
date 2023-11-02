pipeline {
    agent any
    stages {
        stage('Stage clone') {
            steps {
		git branch: 'main', url: 'https://github.com/nhatlong23/webphim.git'
            }
        }
	stage('Build clone') {
            steps {
		withDockerRegistry(credentialsId: 'docker-hub1', url: 'https://index.docker.io/v1/') {
    			sh 'docker build -t 2808zl/phimmoi48h:v1 .'
			sh 'docker push -t 2808zl/phimmoi48h'
		}
            }
        }
    }
}

