# Handling Multiple Web Forms

When multiple forms exist on the same page, keeping track of which form was submitted while also retaining its values for our users can be tricky. Here are some best practices:

1. **Use `action` Attribute**:
   - Ensure each form has an `action` attribute specifying where the form should be submitted.
   - Example:
     ```html
     <form action="process_form1.php" method="POST"></form>
     <form action="process_form2.php" method="POST"></form>
     ```

2. **Include Hidden Inputs**:
   - Add a hidden input field to identify the form being submitted.
   - Example:
     ```html
     <form method="POST">
         <input type="hidden" name="form_id" value="form1">
         <!-- Other inputs -->
     </form>
     ```

3. **Check `$_POST` Data**:
   - Use `isset($_POST['form_id'])` or a similar condition to identify the submitted form.
   - Example:
     ```php
     if (isset($_POST['form_id']) && $_POST['form_id'] === 'form1') {
         // Handle form1 submission
     }
     ```

4. **Retain Form Values**:
   - Repopulate form inputs with submitted values to improve user experience.
   - Example:
     ```php
     $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
     echo "<input type='text' name='name' value='{$name}'>";
     ```

---

#### **Retaining Form Values After Submission**
1. **Use Hidden Inputs**:
   - Pass persistent data (e.g., state or configuration) as hidden inputs in the form.
   - Example:
     ```html
     <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
     ```

2. **Preserve Data with PHP**:
   - Use `$_POST` or `$_GET` data to repopulate form fields.
   - Example:
     ```php
     $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
     echo "<input type='email' name='email' value='{$email}'>";
     ```

3. **Use Sessions**:
   - Store data in `$_SESSION` for persistence across page loads.
   - Example:
     ```php
     session_start();
     $_SESSION['form_data'] = $_POST;
     ```

---

#### **Key Takeaways**
- GET requests expose data in the URL, while POST sends data in the body.
- Forms wipe `$_GET` or `$_POST` data on submission unless explicitly retained.
- To handle multiple forms:
  - Use unique form identifiers (`action`, hidden inputs).
  - Check `$_POST` for the form-specific data.
  - Repopulate inputs using `$_POST` values or sessions.