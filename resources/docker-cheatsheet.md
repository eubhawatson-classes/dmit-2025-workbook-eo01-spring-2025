# Docker Command Cheatsheet

The easiest way to make sure that you are working within the correct directory is to start a new terminal instance within VS Code. To do this, go to: 

`Terminal > New Terminal`

Since this workbook relies on the provided `compose.yml` file to define your PHP, Apache, and MySQL services, you’ll primarily use `docker compose` commands rather than individual `docker run` or `docker stop` commands.


## Image Management

Based upon this workbook's current configuation files, you can build your Docker image with the following command:

`docker build`


## Docker Compose
- **Start services**  
  `docker compose up`

- **Stop services**  
  `docker compose down`

- **Rebuild images**  
  `docker compose build`

- **View compose logs**  
  `docker compose logs [-f]`


## Container Lifecycle
- **List running containers**  
  `docker ps`

- **Stop a container**  
  `docker stop <container>`

- **Start a container**  
  `docker start <container>`

- **Restart a container**  
  `docker restart <container>`

---

## Where is my website?

To view your workbook in a browser, go to: 

`http://localhost:8080/dmit-2025-workbook/`


**Instructor Note**: The instructor workbook can be accessed at:

`http://localhost:8080/dmit-2025-instructor-workbook/`


For phpMyAdmin, visit: 

`http://localhost:8081`

You can log in to phpMyAdmin with either of the following:

| Username  | Password      | Notes                       |
| --------- | ------------- | --------------------------- |
| `root`    | `studentpass` | Full access (use with care) |
| `student` | `student`     | Access to `dmit2025` DB     |

Make sure to select the server as `mysql`, which is the name of the service container (`PMA_HOST: mysql` handles this automatically).

### Troubleshooting Tips

If `http://localhost:8081` doesn’t load:

* Make sure the containers are running: `docker compose ps`
* Restart the stack: `docker compose down && docker compose up --build`
* Check logs: `docker compose logs phpmyadmin`

---

### Notes

`<container>` is a stand-in for the container name. Your container name will be the same as the workbook's name. So, for example, the command to restart a container might be `docker restart dmit-2025-workbook`.

Append `-h` (e.g., `docker run -h`) to any command to view its full help text.