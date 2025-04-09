# code-challange
# Description
This is a very simple example of an API with symfony/php and Angular. 

## Requirements
Front-end:
- Create an environment.ts file and place your your_local_address;
Eg: 
export const environment = {
    test: false,
    production: false,
    hmr: false,
    base_url: 'your_local_address',
    api_url: 'your_local_address/api',
};

Back-end:
- Create an .env file
- Generate a new secret key with php bin/console secrets:generate-keys
- Allow cors if neede CORS_ALLOW_ORIGIN='^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$'
