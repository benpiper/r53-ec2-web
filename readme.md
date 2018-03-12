# r53-ec2-web

Usage
-----

    docker run -p 80:80 -e DBHOSTNAME=db.benpiper.host. benpiper/r53-ec2-web

For other environment variables you can set at runtime, see below.

Building
-------------
The Dockerfile sets the following environment variables which you can adjust prior to building.

| Name | Value | Purpose |
| ---- | ----- | ------- |
|RES_OPTIONS|retrans:1 retry:1 timeout:1 attempts:1|Sets DNS resolution options. Increasing these may cause the page to load more slowly.
|DBHOSTNAME|db.benpiper.host|Hostname of any host listening on TCP/80. This is for testing name resolution of and connectivity to a simulated database.
|HEAP_APP_ID|4262411627|Application ID for tracking pageloads using Heap Analytics. Not setting this variable will disable tracking.