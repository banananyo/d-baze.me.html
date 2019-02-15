node {
    stage('update credecials') {
        sh "git config user.email \"wazjakorn@gmail.com\""
        sh "git config user.name \"wadjakorn\""
    }

    stage('pull') {
        sh "git checkout master"
        sh "git pull origin master"
        sh "git status"
    }
}
