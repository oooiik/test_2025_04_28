# TEST 28.04.2025

## Installation

1. Clone the repository.

2. skip this step if you like the settings in `docker/.env.example` .
   If you don't like the settings here, copy the file (``` cp docker/.env.example docker/.env ```) and adjust it to your needs.

   here are the basic settings:
    ```dotenv
    COMPOSE_PROJECT_NAME=test_2025_04_28 # Project name
    COMPOSE_PROJECT_NETWORK=173.17.0 # Start the network with 3 numbers
    BASE_PATH=./../ # base path for project
    GROUP_ID=1000 # group id in the build (recommend writing `root` for windows)
    USER_ID=1000 # user id in the build (recommend writing `root` for windows)
    ```

3. Docker compose build and up (in `docker` folder)
    ```bash
    docker compose up -d
    ```
4. Use api (default: http://173.17.0.2/api, see `docker/.env` )

5. To stop the server, run the command (in `docker` folder)
    ```bash
    docker compose stop
    ```
   Start the server again with the command (in `docker` folder)
    ```bash
    docker compose
    ```

6. To remove the server, run the command (in `docker` folder)
    ```bash
    docker compose down
    ```

7. See (default: http://173.17.0.2/reports/index.html,) for test results.

8. Excel generation command and queue run
   for excel
    ```bash
    php artisan excel:create
    ```
   for queue
   ```bash
   php artisan queue:work
   ```

7. Enjoy the work of the server. 😁
