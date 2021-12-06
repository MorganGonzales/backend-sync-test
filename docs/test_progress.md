# Test Progress

> Disclaimer: The requirements is not certain on to which tables needs to sync with the external database. So in this 
exercise, I assumed that its all entities (sections > topics > messages)

First thing I did (after installation) was to analyze the existing database structure by:
* Analyze the migration files
* Determine table relationships by check Eloquent Model relations

Created a service logic that will retrieve all records of the three tables (sections, topics, messages) that will copy 
their values to local tables of the same name.

## Decisions...
* Just simply write a query that will retrieve all records starting from the parent entity - as we need to honor the foreign key constraints
* The best way to trigger syncing would be to write a command and have it scheduled establish consistency.
* Created a schedule to run the command `db:sync-messages` daily (can specify off peak/maintenance hours) to maintain consistency on a day to day basis.
* Make sure that records were chunked to support high volume of records - and not to overload the DB with too many records in one query
* Enclosed the entire process into a `transaction` to make sure everything has been synced correctly (no partial sync).

## Known Limitations...
* It just keeps on syncing the entire three tables (sections, topics, messages) with what's on the external db without knowing which record has changed.

## Future Improvements...
### In case we just need to do incremental syncing of records
1. Create a new field (`synced_at`) on each tables (sections, topics, and messages) to determine the date of when it was last synced.
2. Fetch all external table records and store it in each Collection object to pluck its IDs and compare with what we have in local - in case a record was deleted.
3. Get the latest `synced_at` value in each local tables for basis of comparison
4. Using the Collection object we created on each external tables, we query those records whose `updated_at` values are greated than the `synced_at` value from step 3.
5. Then we update local records from the result of each query (for each table) from step #4.
