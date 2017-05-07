------------------
Flow/Neos Setup for platform.sh
------------------

This repository provides a sample setup for Flow and Neos projects on platform.sh
In general the .platform.app.yaml file is defining what to do during build and deployment (e.g. warming up Caches, migrating the database etc.) and the .platform folder defines what services and routes are active.

The platform folder contains a PHP script that replaces the placeholders in the Settings.yaml file that is copied to the Configuration folder during build with the database credentials.
These credentials are provided by platform.sh automatically. For reference check out the documentation of platform.sh https://passly.de/pcpndov

Currently the .environment file is used to set the Context of Neos and Flow.
If you need branch-specific contexts, remove the FLOW_CONTEXT evn variable from the file and set the Context using the platform.sh CLI tool.
E.g. to set the context for the master branch:
platform variable:set -e master env:flow_context Production

Setting the context to Production/Staging for the develop branch:
platform variable:set -e develop env:flow_context Production/Staging
