Project setup for leapt/core-bundle with Flysystem
--------------------------------------------------

Simple Symfony project setup to test leapt/core-bundle file uploads with Flysystem.

Set up:

```bash
git clone https://github.com/jmsche/leapt-core-flysystem.git
cd leapt-core-flysystem
composer i
symfony console d:s:u --force
symfony serve -d
```

Then configure AWS config in your .env.local file (based on .env file) and head to the URL provided by Symfony CLI.
