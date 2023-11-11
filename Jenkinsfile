pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "2808zl/phimmoi48h"
        DOCKERFILE_PATH="${WORKSPACE}/Job-Phimmoi48h/docker/Dockerfile"
    }

    stages {
        stage('Clone Repository') {
            steps {
                git branch: 'main', credentialsId: 'Github', url: 'https://github.com/nhatlong23/webphim.git'
            }
        }

        stage('Build Docker Image') {
            // agent { node { label 'main' } }
            environment {
                DOCKER_TAG="${GIT_BRANCH.tokenize('/').pop()}-${GIT_COMMIT.substring(0,7)}"
            }
            steps {
                script {
                    echo "Dockerfile path: ${DOCKERFILE_PATH}"
                    sh "docker build -t ${DOCKER_IMAGE}:${DOCKER_TAG} -f ${DOCKERFILE_PATH} ."
                    sh "docker tag ${DOCKER_IMAGE}:${DOCKER_TAG} ${DOCKER_IMAGE}:latest"
                    sh "docker image ls | grep ${DOCKER_IMAGE}"
                    withCredentials([usernamePassword(credentialsId: 'docker-hub-password', usernameVariable: 'DOCKER_USERNAME', passwordVariable: 'DOCKER_PASSWORD')]) {
                        sh "echo $DOCKER_PASSWORD | docker login --username $DOCKER_USERNAME --password-stdin"
                        sh "docker push ${DOCKER_IMAGE}:${DOCKER_TAG}"
                        sh "docker push ${DOCKER_IMAGE}:latest"
                    }
                    // Clean up to save disk
                    sh "docker image rm ${DOCKER_IMAGE}:${DOCKER_TAG}"
                    sh "docker image rm ${DOCKER_IMAGE}:latest"
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

        // stage('Run Tests') {
        //     steps {
        //         // Perform any testing steps here if needed
        //     }
        // }

        // stage('Deploy') {
        //     steps {
        //         // Perform any deployment steps here if needed
        //     }
        // }
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
