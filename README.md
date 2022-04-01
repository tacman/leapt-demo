Demo project for leapt/core-bundle
----------------------------------

Simple Symfony project setup to test leapt/core-bundle.

Currently configured:

* File uploads
* Paginator

Set up (using [Symfony CLI](https://symfony.com/download) & [Task](https://taskfile.dev/)):

```bash
git clone https://github.com/jmsche/leapt-core-demo.git
cd leapt-core-demo
task composer
task fixtures
task start
```

To stop the Symfony server:

```bash
task stop
```

Then configure AWS config in your `.env.local` file (based on `.env` file) and head to the URL provided by Symfony CLI.
