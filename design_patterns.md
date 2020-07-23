# Design Patterns

## MVC (Model View Controller)

MVC is a design pattern that seperates logic from view in a pretty simple manner. It is used for example in PHP Frameworks like Laravel. Main concepts of MVC is:

- Model - description of model as a class/object that will come from DB or will be created. It common for MVC to exist together with ORM. Models are used to define relations between them and specify their attributes.
- View - it is a part of the pattern where You present data to the user, we can call it a presentation layer. It is ot doing any logical operations, just making sure that all data sent to it from Controller will be displayed nicely
- Controller - handles logic, make use of models and sends data to views. It can manage all data, have a lot of functions, make calls to external and internal APIs and so on, everything that is related to logic is there.

## Decorator Pattern

Decorator Pattern is a Design Pattern that is used to add functionality to existing object / class without altering class code itself. You can think of it as a wrapper to a given class. It wraps the original class and have additional functionality defined for objects of that class.
For example it might be a Mob interface in some game which has to be extended by adding some hostile mechanics. Instead of breaking the Mob interface stuff and changing all classes implementing it, we can create a Decorator called HostileMob which can manipulate all objects that implement Mob interface. By using this approach, you can add new functionality to every Mob without touching its source code.
It can be an especially useful approach in a situation where You have some external code that maybe You can't change or don't want to mess with it for some reasons.

## Builder Pattern

Builter pattern is used to create a complicated object using many simple objects. It uses other classes and is one of the best patterns for creating an object. Builders are also independent of other objects cause they are STRONK and can manage everything themselves.

# Note
I've added 3 instead of 2 because some firms have told me that they don't treat MVC as a Design Pattern so I just want to be safe.