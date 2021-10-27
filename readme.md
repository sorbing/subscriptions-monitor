## PHP monitoring of the users subscriptions

Deploy:

1. Create a DB & exec the `migrations/schema.sql`.
2. Copy & edit the config file:
   ```shell
   cp config.sample.php config.php
   ```
3. Apply seed:
   ```shell
   php public/script.php seed
   ```
