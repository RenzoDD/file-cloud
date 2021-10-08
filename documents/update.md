
# Update to 1.1

First, you will need to create the following functions/procedures in your database (the code is provided in the new databas scripts):

* Functions
  * RandStr
* Procedures
  * Files_Create
  * Files_Read_Identity

After that, to update your existing data you will need to run this SQL code.

```sql
ALTER TABLE Files ADD COLUMN Identity VARCHAR(10) AFTER Token;

UPDATE Files SET Identity = RandStr(10);

ALTER TABLE Files MODIFY COLUMN Identity VARCHAR(10) NOT NULL UNIQUE;
```

The first line alters the existing file table to add a new column for new functionality.

The second query updates the existing data in the table according to new specifications.

Finally, the third command sets the final parameters for the table.

**Note: If you are installing the software for the first time these changes are already implemented in the database scripts.**