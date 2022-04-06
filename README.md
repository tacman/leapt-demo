Demo project for leapt/core-bundle
==================================

Simple Symfony project setup to test leapt/core-bundle.

Currently configured:

* File uploads
* Paginator
* Form types
* RSS feeds
* Sitemap

Set up (using [Symfony CLI](https://symfony.com/download)):

```bash
# Clone project
git clone https://github.com/jmsche/leapt-core-demo.git
cd leapt-core-demo

# Install vendors
symfony composer i

# Reset database
rm -f var/data.db
symfony console d:d:c --quiet
symfony console d:s:u --force --quiet
symfony console a:f:l

# Run Symfony CLI server
symfony serve -d

# To stop Symfony CLI server:
symfony server:stop
```

Then configure AWS config in your `.env.local` file (based on `.env` file) if you want to test S3 upload and head to the URL provided by Symfony CLI.
