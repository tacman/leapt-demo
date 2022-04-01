Demo project for leapt/core-bundle
----------------------------------

Simple Symfony project setup to test leapt/core-bundle.

Currently configured:

* File uploads
* Paginator

Set up:

```bash
git clone https://github.com/jmsche/leapt-core-demo.git
cd leapt-core-demo
composer i
symfony console d:s:u --force
symfony serve -d
```

Then configure AWS config in your `.env.local` file (based on `.env` file) and head to the URL provided by Symfony CLI.
