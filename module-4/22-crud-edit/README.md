# CRUD Applications: Edit

Editing (or updating) a record in a CRUD application is one of the trickier operations because it combines aspects of all the other CRUD pages:  

- **Like the home page**, it retrieves all records from the database and displays them in an HTML table. 
- **Like the delete page**, it includes an additional "Edit" button for each record.  
- **Like the add page**, it presents a form for modifying records.  

However, editing introduces an extra crinkle in complexity, as we have to manage **two separate sets of data**:  

1. **Existing Data** – The record currently stored in the database.  

2. **Updated Data** – The new values that the user provides.  


## Program Flow  

### 1. Initial Page Load (START)
- The user loads the `edit.php` page.  
- Our script connects to the database, selects all records in our table, and generates an HTML table (with an additional 'actions' column).

### 2. Selecting a Record to Edit  
- When the user clicks "Edit," the page reloads with the selected record’s **primary key** in the query string (e.g., `edit.php?cid=5`).  
- The selected record is retrieved from the database.  

### 3. Displaying the Edit Form  
- The user is given a form where all of the fields are prepopulated with the information already in the database.
- This allows them to update only the necessary fields (e.g., fixing a typo in a name).  
- The original HTML table remains visible in case they decide to edit a different record instead.  

### 4. Submitting and Validating Data  
- The user makes their changes and submits their edited data. 
- The script validates the updated data. 

### 5. Updating the Database  
- If validation **succeeds**, the record it updated in the database.  
- If validation **fails**, the user is prompted to correct their mistakes and try again.

---

## Getting Started  

Before beginning today's lesson, follow these steps:  

1. **Copy and Paste Previous Files**  
   - Locate the `private` and `public` directories from the previous lesson.  
   - Copy and paste them into your working directory for this lesson.  

2. **Upload Files to the Server**  
   - Use an FTP client (e.g., FileZilla) to upload the copied files to the server.  
   - Verify that all files are successfully transferred before proceeding.  

### Files to Modify Today  

Today, we'll be making changes to the following files:  

- **`private/prepared.php`** – Add a function to select a single record, plus an `UPDATE` function.  
- **New File:** `public/edit.php`