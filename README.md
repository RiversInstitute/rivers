# Rivers
Rivers Institute website built with Kirby 4.0.

## Architecture
A staging site can be found at [staging.riversinstitute.org](https://staging.riversinstitute.org). Production is at [riversinstitute.org](https://riversinstitute.org). These are both served from the same DO droplet with two nginx vhosts.

On the server, the branches can be found in the following directories:
```
/var/www/riversinstitute.org
/var/www/staging.riversinstitute.org
```

## Syncing production /content to staging site
Pulling content to the staging site can be done on the server using rsync. THIS COMMMAND NEEDS TESTING:
```
ssh ubuntu@137.184.155.65 'rsync -avz --delete /var/www/riversinstitute.org/content/ /var/www/staging.riversinstitute.org/content/ --dry-run'
```
TK a way to pull /content to your local env

## Deployment workflow
Automated deployments are done via [GitHub Actions](https://github.com/rivers-institute/rivers/actions).

⚠️ Never make changes directly to this server directory otherwise the deployment action will fail. This is also best practice since Git is a version control system.

## Production
Production is deployed automatically from the `master` branch. Once a PR is merged into `master`, the site is deployed to the main domain.

## Running the site locally
Kirby 4.0 works with PHP 8.3.

```
php -S localhost:8000 kirby/router.php
```

CSS is compiled with Sass.

## To generate css, run:
```
sass --watch assets/scss/main.scss:assets/css/main.css
```
