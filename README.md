PhpExampleMVC - example micro-framework for site-blog.
====================
Structure of folders
--------------------
/app/                             - isolated logic for domain knowledge
* /app/api/                       - application programming interface
    * /api// *.php                - main class
    * /api/ * /router.php         - routing scheme
    * /api/ * /jobs.php           - jobs for router.json

/app/view/                        - view-presenter logic
* /view/<anyName>.html            - html view instance

/engine/                          - isolated code for system logic
* /engine/database.php            - code for interactions with database
* /engine/router.php              - code for interactions with routing system
* /engine/Model.php               - class for implementation of instances, which work in app logic

(where "*" is instance name)

example for User instance:

        /api/User/User.php              - main class
        /api/User/router.json           - routing scheme
        /api/User/jobs.php              - jobs for router.json

        /view/User/<anyName>.html       - html presenter