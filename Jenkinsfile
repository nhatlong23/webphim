pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "2808zl/phimmoi48h"
        DOCKERFILE_PATH = "${WORKSPACE}/docker/Dockerfile"
        DOCKER_CONFIG = "${WORKSPACE}/docker/.docker"
        CONTAINER_NAME = "webphim_server"
    }

    stages {
        stage('Clone Repository') {
            steps {
                git branch: 'main', credentialsId: 'Github', url: 'https://github.com/nhatlong23/webphim.git'
            }
        }

        stage('Build Docker Image') {
            environment {
                DOCKER_TAG = "${GIT_BRANCH.tokenize('/').pop()}-${BUILD_NUMBER}-${GIT_COMMIT.substring(0, 7)}"
            }
            steps {
                script {
                    sh "docker image ls | grep ${DOCKER_IMAGE}"
                    sh "rm -rf ${DOCKER_CONFIG}"
                    sh "mkdir -p ${DOCKER_CONFIG}"
                    withCredentials([usernamePassword(credentialsId: 'docker-hub-password', usernameVariable: 'DOCKER_USERNAME', passwordVariable: 'DOCKER_PASSWORD')]) {
                        sh "echo $DOCKER_PASSWORD | docker --config=${DOCKER_CONFIG} login --username $DOCKER_USERNAME --password-stdin"
                    }
                    sh "docker build -t ${DOCKER_IMAGE}:${DOCKER_TAG} -f ${DOCKERFILE_PATH} ."
                    sh "docker push ${DOCKER_IMAGE}:${DOCKER_TAG}"
                    script {
                        if (GIT_BRANCH ==~ /.*main.*/) {
                            sh "docker tag ${DOCKER_IMAGE}:${DOCKER_TAG} ${DOCKER_IMAGE}:latest"
                            sh "docker push ${DOCKER_IMAGE}:latest"
                        }
                    }
                    // Clean up to save disk
                    sh "docker image rm ${DOCKER_IMAGE}:${DOCKER_TAG}"
                }
            }
        }

        stage('Run Docker Container') {
            steps {
                script {
                    // Stop and remove existing container
                    sh "docker stop ${CONTAINER_NAME} || true"
                    sh "docker rm ${CONTAINER_NAME} || true"
                    // Run the new container
                    // sh "docker run -d -p 80:80 -p 443:443 --name ${CONTAINER_NAME} ${DOCKER_IMAGE}:latest"
                }
            }
        }

        // stage('Run Tests') {
        //     steps {
        //         // Perform any testing steps here if needed
        //     }
        // }

        stage('Deploy') {
            steps {
                script {
                    withCredentials([sshUserPrivateKey(credentialsId: 'ssh-key', keyFileVariable: 'SSH_KEY')]) {
                        sh "ssh -i ${SSH_KEY} -l jenkins 34.124.153.247 './delopy.sh'"
                    }
                }
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