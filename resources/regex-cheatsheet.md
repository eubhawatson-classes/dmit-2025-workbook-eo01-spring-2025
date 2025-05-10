# RegEx Cheat Sheet

A regex (short for regular expression) is a sequence of characters that defines a search pattern. It is used to match, search, or validate text based on specific rules. For example, regex can check if an email address is in the correct format or if a password meets complexity requirements.

All of the following may be used in the `pattern` attribute on a form control. For example, if we wanted to prompt a user for a full name, we could check to make sure that there are letters, a space, and more letters with the following regular expression: 

```HTML
  <label for="full-name">Full Name</label>
  <input type="text" id="full-name" name="full-name" pattern="^[a-zA-Z]+([ '-][a-zA-Z]+)*$" required>
```

---

## Names

- **First and Last Name**: Allows letters, hyphens, and spaces (basic, flexible approach).
  ```regex
  ^[a-zA-Z]+([ '-][a-zA-Z]+)*$
  ```

- **Strict Full Name**: First and last name, no middle name, first letter capitalized.
  ```regex
  ^[A-Z][a-z]+ [A-Z][a-z]+$
  ```

## Passwords

- **Complex Password**: At least 8 characters, includes uppercase, lowercase, digit, and special character.
  ```regex
  (?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}
  ```

- **Moderate Password**: At least 6 characters, includes letters and numbers.
  ```regex
  (?=.*[a-zA-Z])(?=.*\d)[A-Za-z\d]{6,}
  ```


## Cards

- **Credit Card (Visa, MasterCard, Amex)**:
  ```regex
  ^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|3[47][0-9]{13})$
  ```


## Postal Codes

- **Canadian Postal Code**: A combination of six letters and numbers, in the following format: H0H 0H0
  ```regex
  ^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$
  ```

- **US ZIP Code**: Five consecutive numbers, in the following format: 90210
  ```regex
  ^\d{5}(-\d{4})?$
  ```


## Dates

Note on dates: the `<input type="date">` form control handles dates fairly well. It may present dates to the user in different ways, based upon their browser and operating system settings. 

On the back-end, most dates are taken and converted to Unix Time (i.e. the number of seconds since 01 January 1970 at 00:00). This may change in coming years depending upon how the 2038 Unix Epoch problem is solved (i.e. when the number of seconds can no longer be stored in a 32-bit integer or string).

- **DD/MM/YYYY**: Validates dates in a European date format.
  ```regex
  ^(0[1-9]|[12]\d|3[01])-(0[1-9]|1[0-2])-\d{4}$
  ```

- **MM/DD/YYYY**: Validates dates in a `MM/DD/YYYY` or American format.
  ```regex
  ^(0[1-9]|1[0-2])/(0[1-9]|[12]\d|3[01])/\d{4}$
  ```

- **YYYY-MM-DD**: ISO format date validation. This is the preferred format for most databasers, as it will be in order whether you sort it in an ascending or descending order. 
  ```regex
  ^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$
  ```


## Phones

- **US & Canada Phone Number**: Matches standard American and Canadian phone formats with optional country code.

  ```regex
  ^(\+1[-.\s]?)?(\(?\d{3}\)?[-.\s]?)?\d{3}[-.\s]?\d{4}$
  ```

- **International Phone Number**: Allows for various international formats with optional "+".

  ```regex
  ^\+?\d{1,3}?[-.\s]?\(?\d{1,4}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,9}$
  ```

- **UK Phone Number**

```RegEx
	^\s*\(?(020[7,8]{1}\)?[ ]?[1-9]{1}[0-9{2}[ ]?[0-9]{4})|(0[1-8]{1}[0-9]{3}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{3})\s*$
```


## Emails

- **Basic Email**: Matches common email formats.
  ```regex
  ^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$
  ```

Note: HTML provides the email input type, which performs a validation check against email address patterns. It will work better than any regex you can find or come up.

	```HTML
		<input type="email" name="email" id="email" placeholder="ex. hello@email.com" required>
	```


## Colours

- **Hexadecimal Color**: Matches `#` followed by 3 or 6 hexadecimal characters.
  ```regex
  ^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$
  ```


## Miscellaneous

### Numbers

- **Positive Integer**:
  ```regex
  ^[1-9]\d*$
  ```

- **Numbers**: with or without decimals, in any of the following formats: 9 or 9.9 or 9,9
  ```RegEx
  [-+]?[0-9]*[.,]?[0-9]+
  ```


### URLs

- **URL**: Matches common URL structures (basic).
  ```regex
  ^https?://[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}(/[\w.-]*)*$
  ```

- **Simple URL**: Domains like "abc.de", without the protocol. Note that `<input type="url">` is more strict and requires `http://` or `https://`.
  ```regex
  ((^|:)([0-9a-fA-F]{0,4})){1,8}$
  ```

### IP Addresses

- **IPv4 Address**: Matches Internet Protocol Version 4 addresses, such as: 192.168.0.1
  ```regex
  ^((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.|$)){4}$
  ```

- **IPv6 Address**: Matches Internet Protocol Version 6 addresses, such as: 2001:0db8:85a3:0000:0000:8a2e:0370:7334
  ```regex
  ^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$
  ```

### Navigation

- **Latitude or Longitude**: Coordinates used to locate any place on earth, using the following format: 51°30'26"N, 0°7'40"W
  ```regex
  -?\d{1,3}\.\d+
  ```

  Latitude: Measures how far north or south a point is from the equator. Ranges from -90° to 90°.

  Longitude: Measures how far east or west a point is from the Prime Meridian. Ranges from -180° to 180°.


### Currency

- **Price**: In whole currency (ex. euros, dollars) and cents, in the `0.00` format. The symbol for the currency is not included. 
  ```regex
  \d+(\.\d{2})?
  ```

- **Price** In whole currency (ex. euros, francs) and cents, using commas for the decimal point (`1,00`). This is common in countries like France.
  ```regex
  \d+(,\d{2})?
  ```


### Publications

- **ISBN**: A International Standard Book Number comes in two different formats: 

  - ISBN-10: 10 digits (used until 2007), ex: 0306406152
  - ISBN-13: 13 digits (current standard), ex: 9780306406157

  ```regex
  (?:(?=.{17}$)97[89][ -](?:[0-9]+[ -]){2}[0-9]+[ -][0-9]|97[89][0-9]{10}|(?=.{13}$)(?:[0-9]+[ -]){2}[0-9]+[ -][0-9Xx]|[0-9]{9}[0-9Xx])
  ```


### Cryptography

- **MD5 Hash**: An MD5 hash is a 128-bit hash represented as a 32-character hexadecimal string, such as: 5d41402abc4b2a76b9719d911017c592

  ```regex
  [0-9a-fA-F]{32}
  ```

  MD5 is commonly used for checksums and basic hashing but is not cryptographically secure for storing sensitive data (ex. passwords, credit card numbers, mailing addresses). 

  Note that this RegEx will ensure that the pattern is correct, but it does not actually verify the hash.

---

## References


MDN: Regular expression syntax cheat sheet

https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Regular_expressions/Cheatsheet#character_classes

Description: "This page provides an overall cheat sheet of all the capabilities of RegExp syntax by aggregating the content of the articles in the RegExp guide."