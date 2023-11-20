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
                git branch: 'develop', credentialsId: 'Github', url: 'https://github.com/nhatlong23/webphim.git'
            }
        }

        stage('Build Docker Image') {
            environment {
                DOCKER_TAG = "${GIT_BRANCH.tokenize('/').pop()}-${BUILD_NUMBER}-${GIT_COMMIT.substring(0, 7)}"
            }
            steps {
                script {
                    def dockerImageExists = sh(script: "docker image ls | grep ${DOCKER_IMAGE}", returnStatus: true)
                    if (!dockerImageExists) {
                        sh "rm -rf ${DOCKER_CONFIG}"
                        sh "mkdir -p ${DOCKER_CONFIG}"
                        withCredentials([usernamePassword(credentialsId: 'docker-hub-password', usernameVariable: 'DOCKER_USERNAME', passwordVariable: 'DOCKER_PASSWORD')]) {
                            sh "echo $DOCKER_PASSWORD | docker --config=${DOCKER_CONFIG} login --username $DOCKER_USERNAME --password-stdin"
                        }
                        sh "docker build -t ${DOCKER_IMAGE}:${DOCKER_TAG} -f ${DOCKERFILE_PATH} ."
                        sh "docker push ${DOCKER_IMAGE}:${DOCKER_TAG}"
                        if (GIT_BRANCH ==~ /.*main.*/) {
                            sh "docker tag ${DOCKER_IMAGE}:${DOCKER_TAG} ${DOCKER_IMAGE}:latest"
                            sh "docker push ${DOCKER_IMAGE}:latest"
                        }
                        // Clean up to save disk
                        sh "docker image rm ${DOCKER_IMAGE}:${DOCKER_TAG}"
                    } else {
                        echo "Docker image ${DOCKER_IMAGE} already exists. Skipping the build."
                    }
                }
            }
        }

        // stage('Run Docker Container') {
        //     steps {
        //         script {
        //             // Stop and remove existing container
        //             sh "docker stop ${CONTAINER_NAME} || true"
        //             sh "docker rm ${CONTAINER_NAME} || true"
        //             // Run the new container
        //             sh "docker run -d -p 80:80 -p 443:443 --name ${CONTAINER_NAME} ${DOCKER_IMAGE}:latest"
        //         }
        //     }
        // }

        // stage('Run Tests') {
        //     steps {
        //         // Perform any testing steps here if needed
        //     }
        // }

        stage('Deploy') {
            steps {
                script {
                    sshPublisher(
                        publishers: [
                            sshPublisherDesc(
                                configName: 'ssh-server',
                                transfers: [
                                    sshTransfer(
                                        cleanRemote: false,
                                        excludes: '',
                                        execCommand: "cp ${WORKSPACE}/.env.example ${WORKSPACE}/.env && ${WORKSPACE}/deploy.sh",
                                        execTimeout: 120000,
                                        flatten: false,
                                        makeEmptyDirs: false,
                                        noDefaultExcludes: false,
                                        patternSeparator: '[, ]+',
                                        remoteDirectory: '',
                                        remoteDirectorySDF: false,
                                        removePrefix: '',
                                        sourceFiles: '.env.example'
                                    )
                                ],
                                usePromotionTimestamp: false,
                                useWorkspaceInPromotion: false,
                                verbose: false
                            )
                        ]
                    )
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
