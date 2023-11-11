pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "2808zl/phimmoi48h"
    }

    stages {
        stage('Clone Repository') {
            steps {
                git branch: 'main', credentialsId: 'Github', url: 'https://github.com/nhatlong23/webphim.git'
            }
        }

        stage('Build Docker Image') {
            agent { node { label 'main' } }
            environment {
                DOCKER_TAG="${GIT_BRANCH.tokenize('/').pop()}-${GIT_COMMIT.substring(0,7)}"
            }
            steps {
                script {
                    sh "docker build -t ${DOCKER_IMAGE}:${DOCKER_TAG} . "
                    sh "docker tag ${DOCKER_IMAGE}:${DOCKER_TAG} ${DOCKER_IMAGE}:latest"
                    sh "docker image ls | grep ${DOCKER_IMAGE}"
                    withCredentials([usernamePassword(credentialsId: 'docker-hub-password', usernameVariable: 'DOCKER_USERNAME', passwordVariable: 'DOCKER_PASSWORD')]) {
                        sh "echo $DOCKER_PASSWORD | docker login --username $DOCKER_USERNAME --password-stdin"
                        sh "docker push ${DOCKER_IMAGE}:${DOCKER_TAG}"
                        sh "docker push ${DOCKER_IMAGE}:latest"
                    }
                    //clean to save disk
                    sh "docker image rm ${DOCKER_IMAGE}:${DOCKER_TAG}"
                    sh "docker image rm ${DOCKER_IMAGE}:latest"
                    withDockerRegistry(credentialsId: 'docker-hub1', url: 'https://index.docker.io/v1/') {
                        sh 'docker build -t 2808zl/phimmoi48h:v1 .'
                        sh 'docker push 2808zl/phimmoi48h:v1'
                    }
                }
            }
        }

        stage('Run Docker Container') {
            steps {
                script {
                    docker.image(env.DOCKER_IMAGE).withRun('-p 80:80 -p 443:443 --name webphim_server')
                }
            }
        }

        stage('Run Tests') {
            steps {
                // Thực hiện các bước kiểm thử ở đây nếu cần
            }
        }

        stage('Deploy') {
            steps {
                // Thực hiện các bước triển khai ở đây nếu cần
            }
        }
    }

    post {
        success {
            echo 'Build and deployment successful!'
        }

        failure {
            echo 'Build or deployment failed!'
        }
    }
}
