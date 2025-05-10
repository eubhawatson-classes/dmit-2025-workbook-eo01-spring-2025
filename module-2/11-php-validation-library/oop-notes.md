# Object-Oriented Programming (OOP)

OOP (Object-Oriented Programming) is a way to build programs using building blocks called objects.

---

## What’s an Object?

An object is a piece of your program that has:

1. **Data** (stuff it knows).
2. **Abilities** (stuff it can do).

Think of an object like your phone:

- **Data (stuff it knows)**: Its brand, model, color, and battery percentage.
- **Abilities (stuff it can do)**: Make calls, take photos, or play music.

In code, an object might look like this:

```php
$phone = new Phone();
$phone->brand = "Samsung"; // Data
$phone->makeCall();        // Ability
```

---

## How Do We Create Objects?

To make objects, we first need a template or a blueprint. In OOP, this is called a **class**.

Classes are just a recipe for making objects. They describe:

1. What data the objects will have.
2. What abilities they can perform.

OOP is all about reusing these blueprints. You make a class once, and then you can create as many objects as you want. Each object can have its own data and still share the same abilities.


## Let’s Build an Example: A Cookie Class

Think of a **class** as a cookie cutter. In this example, the **objects** are the individual cookies.

Here’s a simple blueprint (class) for cookies:

```php
class Cookie {
    public $flavor; // Data: Each cookie has a flavor
    public function eat() { // Ability: You can eat the cookie
        echo "You ate the cookie!";
    }
}
```

Now, we can make some cookies (objects):

```php
$chocolateChipCookie = new Cookie(); // Create a chocolate cookie
$chocolateChipCookie->flavor = "Chocolate Chip"; // Set its flavor
$chocolateChipCookie->eat(); // Eat it
```

Output: 

```
You ate the cookie!
```

---

### One More Example: A Dog Class

Let’s imagine you want to model a dog in code.

First, you need to define the blueprint (the class).

   ```php
   class Dog {
       public $name; // The dog’s name
       public $breed; // The dog’s breed

       public function bark() { // Dogs can bark
           echo "Woof! Woof!";
       }
   }
   ```

Next, we can create an individual dog with different property values.

   ```php
   $myDog = new Dog(); // Create a dog
   $myDog->name = "Honey"; // Name the dog
   $myDog->breed = "Great Pyrenees"; // Set its breed
   $myDog->bark(); // Make the dog bark
   ```

Output:
```
Woof! Woof!
```

--- 

## Key Terms

1. **Class**: The blueprint. It defines what objects of that type can do and what they know.
   - Example: A “Car” class.

2. **Object**: An actual thing you create from a class.
   - Example: Your car or your friend’s car, both made from the same “Car” class.

3. **Properties**: The stuff an object knows. These are like variables inside the object.
   - Example: A car’s colour or brand.

4. **Methods**: The stuff an object can do. These are like functions inside the object.
   - Example: A car can start or honk.