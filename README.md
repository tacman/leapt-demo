Demo project for Leapt bundles
==============================

Simple Symfony project setup to test some Leapt bundles.

Requires PHP 8.1+ as it runs Symfony 6.4.

Currently configured:

* Data lists
* File uploads
* Paginator
* Form types
* RSS feeds
* Sitemap

Set up (using [Symfony CLI](https://symfony.com/download)):

```bash
# Clone project
git clone https://github.com/leapt/demo.git leapt-demo
cd leapt-demo

# Install vendors
symfony composer i

# Reset database
rm -f var/data.db
symfony console d:d:c --quiet
symfony console d:s:u --force --quiet
symfony console a:f:l
# Or, if you use Task:
task fixtures

# Run Symfony CLI server
symfony serve -d

# To stop Symfony CLI server:
symfony server:stop
```

Then configure AWS config in your `.env.local` file (based on `.env` file) if you want to test S3 upload and head to the URL provided by Symfony CLI.
