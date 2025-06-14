# SQL Cheatsheet (for MySQL / MariaDB)

## CREATE TABLE

Define a new table with columns, types, and constraints:

```sql
CREATE TABLE table_name (
  column1 INT PRIMARY KEY AUTO_INCREMENT,
  column2 VARCHAR(255) NOT NULL,
  column3 DATE,
  column4 DECIMAL(10,2) DEFAULT 0.00,
  -- add more columns as needed
  UNIQUE (column2)
);
```

---

## Common Data Types in MariaDB

### Numeric Types

| Type              | Description                      | Storage     | Signed Range                              |
| ----------------- | -------------------------------- | ----------- | ----------------------------------------- |
| `TINYINT`         | Small integers (booleans, flags) | 1 byte      | -128 to 127                               |
| `SMALLINT`        | Small whole numbers              | 2 bytes     | -32,768 to 32,767                         |
| `MEDIUMINT`       | Medium-sized integers            | 3 bytes     | -8.3 million to 8.3 million               |
| `INT`/`INTEGER`   | Standard whole numbers           | 4 bytes     | -2.1 billion to 2.1 billion               |
| `BIGINT`          | Very large numbers               | 8 bytes     | ±9 quintillion                            |
| `DECIMAL(p,s)`    | Fixed-point for precise values   | Varies      | Good for currency, exact decimals         |
| `FLOAT`, `DOUBLE` | Approximate decimals             | 4 / 8 bytes | Risk of rounding errors (not good for \$) |

## Date & Time Types

| Type        | Example                       | Notes                                   |
| ----------- | ----------------------------- | --------------------------------------- |
| `DATE`      | `2025-04-11`                  | Stores only the date                    |
| `DATETIME`  | `2025-04-11 13:45:00`         | Date + time (no timezone)               |
| `TIMESTAMP` | Auto-updating timestamp (UTC) | Good for tracking creation/modification |


## String Types

| Type         | Description                           | Storage                              |
| ------------ | ------------------------------------- | ------------------------------------ |
| `CHAR(n)`    | Fixed-length string (pad with spaces) | 1–255 bytes                          |
| `VARCHAR(n)` | Variable-length string                | 1–65,535 bytes (limited by row size) |
| `TEXT`       | Large text block (not indexable)      | 2^16–1 (up to 64KB)                  |
| `ENUM(...)`  | One value from a fixed list           | 1–2 bytes, efficient & safe          |


---

## Column Lengths

Specify maximum storage or precision:

* `VARCHAR(255)` — up to 255 characters
* `CHAR(10)` — always 10 characters (pads with spaces)
* `DECIMAL(10,2)` — up to 10 digits total, 2 after the decimal
* `INT(11)` — display width only (storage is fixed)

---

## SELECT and FROM

The core of any query:

```sql
SELECT column1, column2
FROM table_name;
```

They must appear in that order: **SELECT** (what) then **FROM** (where).

---

## \*

Select all columns:

```sql
SELECT *
FROM north_farm;
```

---

## LIMIT

Restrict number of rows returned:

```sql
SELECT *
FROM north_farm
LIMIT 100;
```

---

## WHERE

Filter rows by conditions:

```sql
SELECT *
FROM north_farm
WHERE species = 'Bombus';
```

Use whenever you need to narrow results or safely run UPDATE/DELETE.

---

## Comparison Operators

* `=` equal
* `<>` not equal
* `<` less than
* `<=` less than or equal
* `>` greater than
* `>=` greater than or equal

---

## Logical Operators

Combine or negate conditions:

* **AND** — both true

  ```sql
  WHERE year = 2024 AND litres > 100
  ```
* **OR** — at least one true

  ```sql
  WHERE species = 'Bombus' OR species = 'Apis'
  ```
* **NOT** — invert

  ```sql
  WHERE NOT (hive_number = 3)
  ```

---

## LIKE

Pattern matching with wildcards:

* `%` — any sequence of chars
* `_` — any single char

```sql
WHERE name LIKE 'Ava%'    -- starts with 'Ava'
WHERE code LIKE '_1_'     -- any‑1‑any
```

---

## BETWEEN

Range inclusive:

```sql
WHERE harvest_date BETWEEN '2024-06-01' AND '2024-08-31'
```

---

## IS NULL

Test for missing values:

```sql
WHERE notes IS NULL
```

Or negate: `WHERE notes IS NOT NULL`

---

## ORDER BY

Sort results:

```sql
SELECT *
FROM north_farm
ORDER BY year DESC, litres ASC;
```

---

## GROUP BY

Aggregate rows by one or more columns:

```sql
SELECT species, COUNT(*) AS count
FROM north_farm
GROUP BY species;
```

Optionally filter groups with `HAVING`:

```sql
HAVING COUNT(*) > 5
```

---

## OFFSET

Skip a number of rows:

```sql
SELECT *
FROM north_farm
ORDER BY year DESC
LIMIT 10 OFFSET 20;
```

---

## AGGREGATE FUNCTIONS

* **COUNT(col)** — number of non‑NULL values
* **MIN(col)** — minimum
* **MAX(col)** — maximum
* **AVG(col)** — average
* **SUM(col)** — total sum

```sql
SELECT COUNT(*) AS total_rows,
       AVG(litres) AS avg_yield
FROM north_farm;
```

---

## Wildcards

Used in `LIKE` (see above). Also in `SHOW` commands:

```sql
SHOW TABLES LIKE 'north_%';
```

---

## Aliases

Create shorthand or rename in output:

* **Column alias**:

  ```sql
  SELECT year AS yr, litres AS yield
  FROM north_farm;
  ```

* **Table alias**:

  ```sql
  SELECT nf.year, nf.litres
  FROM north_farm AS nf;
  ```