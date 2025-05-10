# PHP Control Structures & Loops: Exercises

Just like our last round of exercises, these will be algorithmic (i.e. they will follow a series of logical steps) and will help us solve specific problems through the lense of this new language. 

---

## Problem 1

Write a program that takes a numerical value and checks to see whether it's positive, negative, zero, or not a number.

---

## Problem 2

Write a program that takes a numerical value and prints its multiplication table.

---

## Problem 3

Write a program that checks the day of the week using the `date()` function.

    Hint: You can get the name of the day of the week by passing in "l".

Print a message telling the user what day it is. Next, using a switch statement, check the day of the week and tell the user what day it would correspond to in the Old Norse calendar. 

Here are the names of the days of the week in the Old Norse calendar, along with the gods and goddesses they were named after:

    Sun's Day (Sunnudagr) - named after the goddess Sunna
    Moon's Day (Mánadagr) - named after the god Máni
    Tyr's Day (Týsdagr) - named after the god Tyr
    Odin's Day (Óðinsdagr) - named after the god Odin
    Thor's Day (Þórsdagr) - named after the god Thor
    Freyja's Day (Freyjudagr) - named after the goddess Freyja
    Saturn's Day (Laugardagr) - named after the planet Saturn

---

## The `date()` Function

In PHP, we can use the language-defined `date()` function to ask the server what the current date and time is. 


### Getting a Date

When asking the server for a date, we can specify how it is formatted. Some commonly used characters for dates are:

- d - Represents the day of the month (01 to 31)
- m - Represents a month (01 to 12)
- Y - Represents a year (in four digits)
- l (lowercase 'L') - Represents the day of the week

```PHP
    echo "Today's date is " . date("Y/m/d"); // This would output the YMD format, which is used in China, Japan, Korea, Taiwan, etc.
```

Other characters, like"/", ".", or "-" can also be passed into the function to add additional formatting.


### Getting the Time

When asking the server for a time, we can use any of the following arguments: 


- H - 24-hour format of an hour (00 to 23)
- h - 12-hour format of an hour with leading zeros (01 to 12)
- i - Minutes with leading zeros (00 to 59)
- s - Seconds with leading zeros (00 to 59)
- a - Lowercase Ante meridiem and Post meridiem (am or pm)

```PHP
    echo "The time is " . date("h:i:sa"); // ex. 05:33:02 p.m.
```

#### A Note on Time Zones

Note that, by default, the server will return whatever the date or time is as per the server's settings. If the server is in another country or set up for a different timezone, we can specify which timezone we'd like to use. 

```PHP
date_default_timezone_set("America/Edmonton");
echo "The time is " . date("h:i:sa");
```

A complete list of supported time zones can be found in the [PHP manual](https://www.php.net/manual/en/timezones.php). 