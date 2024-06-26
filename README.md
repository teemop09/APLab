# APLab

A computer lab management system for Asia Pacific University. Currently being worked on as an assignment.

## Project structure

```txt
APLab
└─src
    ├─assets            // Static assets (images, fonts, etc.)
    ├─css               // Global CSS styles
    ├─js                // Global JavaScript scripts
    ├─pages             // Page-specific folders
    │   ├─user1         // User-specific pages
    │   │   ├─dashboard
    │   │   └─profile
    │   ├─user2
    │   └─...
    ├─users             // User-related functionality
    │   ├─authentication
    │   ├─registration
    │   └─...
    ├─components        // Reusable UI components
    ├─data              // Data management and APIs
    └─utils             // Utility functions and helpers
```

## How to collaborate

### Pre-requisite

Make sure you have Git installed locally on your computer.
Being able to run the following command without error means it is properly installed.

```cmd
git --version
```

### If you don't have existing working directory

Launch terminal or command prompt. `cd` into the folder you want to place the code in. For example, if you want the code files to be in `C:\wamp64\www\APLab\`, then you enter the following.

```cmd
cd C:\wamp64\www\
```

Then clone the repository as follows:

```cmd
git clone https://github.com/teemop09/APLab.git
```

A new folder named `APLab` will be created under the same directory. In this case, it is `C:\wamp64\www\APLab`.

Next time, you should follow the [other section](https://github.com/teemop09/APLab#if-you-have-existing-working-directory) since you have an existing working directory now.

Now you can start [contributing](https://github.com/teemop09/APLab#contributing-to-the-repository)!

### If you have existing working directory

Open terminal and `cd` to your working directory (where you have your code). For example,

```cmd
cd C:\wamp64\www\APLab\
```

Type the following commands:

```cmd
git init

git remote add origin https://github.com/teemop09/APLab.git
```

To download the remote repository to your local repository:

```cmd
git pull origin main
```

You should see your working directory has more folders and files.

Edit and move your existing code files and make sure it works as intended after the changes.

Now you can start [contributing](https://github.com/teemop09/APLab#contributing-to-the-repository)!

## Contributing to the repository

Do the following if you haven't already:

```cmd
git remote add origin https://github.com/teemop09/APLab.git
```

- Add the modified files:

```cmd
git add *

```

- To commit the changes:

```cmd
git commit -m <your message>
```

> replace `<your message>` with the summary/description of what you've modified (what is the purpose)

- To push to the remote repository:

```cmd
git push origin main
```

You will see the changes made if you browse to the [remote repository link](https://github.com/teemop09/APLab) and refresh.
