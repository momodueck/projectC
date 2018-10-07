# projectC
A web project for interactive chords for guitar players

Home | Playing a Song | Editing a Song
------------ | ------------- | -------------
<img src="media/screenshot1.png" title="Screenshot 1"/>  |  <img src="media/screenshot2.png" title="Screenshot 2"> |  <img src="media/screenshot3.png" title="Screenshot 3"/>



## Setup 

For running the laravel project on your local computer you have to
- set up vendor folder with neccessary libraries 
```
  > composer install
```
- create new .env file from .env.example with db setup
- generate Application Encryption Key
```
   > php artisan key:generate
```

## Seed
 
You can seed the database with a few songs using 
```
  > php artisan migrate:fresh --seed

```
## Start Server

start your development server with 

```
  php artisan serve

