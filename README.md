
## System dependencies required

1/ Required for project
- Php >= 7.1.3 
- Composer
- Node js and Npm
- git

## Clone and config

1/ Clone the project with git
```
git clone https://github.com/WildCodeSchool/lyon-0918-ventealaferme.git
```

2/ Configure .env
- Copy `.env` file and rename it `.env.local`
- Open `.env.local` file and configure `DATABASE_URL` line

## Project dependencies

1/ Installing the php project dependencies
```
composer install
```

2/ Drop old database if exists
```
bin/console doctrine:database:drop --force
```

3/ Create database
```
bin/console doctrine:database:create
```

4/ Update database schema
```
bin/console doctrine:schema:update --force
```

5/ Load project fixtures
```
bin/console doctrine:fixtures:load
```

## Assets gesture

**\/!\\Assets is required for design on project\/!\\**

1/ Install symfony webpack encore
```
composer require encore
```

2/ Install node js dependencies
```
yarn
``` 
or 
``` 
npm install
```

3/ Compile a webpack assets
```
yarn encore run dev
```

## Bug resolution

1/ If `yarn run dev` returns errors
- Solution 1 : `composer require encore` and `yarn`

- Solution 2 : delete the `node_modules` folder and type `yarn` and retry the command

## Contributors and copyright

"**Vente à la ferme**" is a Wild Code School project.

1/ List of all project contributors
- [MARGERIT Frédéric](https://github.com/mrgfrederic)
- [Bolanos Camilo](https://github.com/Camilo2309)
- [Chena Fayçal](https://github.com/Kr4v3N)
- [Minaudier Céline](https://github.com/CelineMi)
- [Tuffreaud Félix](https://github.com/Liiinx)

2/ List of all dependencies used in project
- PHP framework used : [Symfony 4](https://symfony.com/download)
- Assets gesture : [Webpack with symfony encore](https://webpack.js.org/)
- Template used : [Bears]()
- Map gesture : [Google maps](https://maps.google.com)



