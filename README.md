# News publisher
This is a news publishing application that lists the news from https://newsdata.io. The admin can publish these news, which are displayed to clients via a WebSocket.

The application has an analyzing service that analyzes the description of published news and calculates an "accent ratio index".

## Requirements

- PHP v8.1
- Composer
- Npm

## Installation

- Create a database
- Create a .env file from .env.example
- Fill .env file with requirement variables
  - Get an API key from https://newsdata.io and set it to NEWS_DATA_API_KEY
  - Create a new app in https://pusher.com, and fill the next variables
    - PUSHER_APP_ID 
    - PUSHER_APP_KEY
    - PUSHER_APP_SECRET
    - PUSHER_APP_CLUSTER
- Run the `composer deploy` to install and build dependencies

## Usage
- Run `php -S 127.0.0.1:8080 -t public` command to start the application

## Author
* Gábor Farkas
## License
[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)
