# APLab
A computer lab management system for Asia Pacific University. Currently being worked on as an assignment.

# How to collaborate
## If you have existing working directory
Make sure you have Git installed locally on your computer.
Being able to run `git --version` without error means it is installed.

Open terminal and `cd` to your working directory (where you have your code). For example, 
```
cd C:\wamp64\www\APLab\
```

Type the following commands:
```
git init

git remote add origin https://github.com/teemop09/APLab.git
```

To download the remote repository to your local repository:
```
git pull origin main
```

You should see your working directory has more folders and files.

Edit and move your existing code files and make sure it works as intended after the changes.

To push your codes to remote repository:

- Add the modified files:
```
git add *
```

- To commit the changes: 
```
git commit -m <your message>
```
> replace `<your message>` with the summary/description of what you've modified (what is the purpose)

- To push to the remote repository:
```
git push origin main
```

You will see the changes made if you browse to the [remote repository link](https://github.com/teemop09/APLab) and refresh.
