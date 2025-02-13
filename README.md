# <span style="color:blue;">About this Project</span>

This is a **Laravel API** application using **Laravel Sail** and **Sanctum** for authentication.  
It requires Docker to run the application in containers.

---

## <span style="color:green;">Prerequisites</span>

To run this project, you'll need:

1. **Docker** (ensure it's installed and running)
   - If you're on Windows, you also need **WSL 2** (Windows Subsystem for Linux).
   - For macOS and Linux, Docker runs natively, so WSL is not required.
2. **PHP 8.3** installed locally (so you can run Composer and initial commands).
3. **Composer** (to install dependencies before running Sail).

---

## <span style="color:purple;">Project Setup</span>

1. **Clone the repository**  
   ```bash
   git clone https://github.com/your-username/your-repo.git
   cd your-repo
   ```

2. **Install dependencies** 
    ```bash
    composer install
    ```
3. **Create your .env file** 
    ```bash
    cp .env.example .env
    ```
4. **Generate the application key**
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```
---

<span style="color:red;">Running the Application</span>

1. **Start the containers** 
    ```bash
    ./vendor/bin/sail up
    ```
    If you want to run them in the background, run:
    ```bash
    ./vendor/bin/sail up -d
    ```
2. **Run migrations**
    ```bash
    ./vendor/bin/sail artisan migrate
    ```
3. **Seed the database (optional)**
    ```bash
    ./vendor/bin/sail artisan db:seed
    ```
Now your Laravel application should be up and running on http://127.0.0.1 (or the port you configured).

<span style="color:orange;">Usage</span>

- API Endpoints:
    You can interact with the API endpoints using tools like Postman or Insomnia.

- Authentication (Sanctum):
    Sanctum is used for token-based authentication. Check Laravel’s Sanctum documentation for details on how to issue and use tokens.

Stopping the containers:
Press CTRL + C in the terminal where Sail is running (if not in detached mode) or run:
    
    ./vendor/bin/sail down