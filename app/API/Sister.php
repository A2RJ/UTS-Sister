/*
****
Note: Make sure you read/skim to the end, even if you figure out the first solution quickly (which you should). The second solution has a bit of brief research to go along with it! :-)
****

At times, it can be useful to have a class that maintains state long enough to complete a cycle, but doesn't get stored in memory. No extra baggage needed, right?

For times like those, you'd like to use something like:
*/

new MyClass()->do_this()->do_that()->finish();

/*
... but, you can't.

The solution is found when you realize that you need to replace "new MyClass" with something that can be chained off of. In addition to PHP variables, static method calls can also be chained off of (surprisingly enough).

So, something like this would work:
*/

MyClass::create()->do_this()->do_that()->finish();

/*
So, let's create the awesome MyClass and give it a static function that will return a chainable object:
*/

class MyClass {
   private $_one = 1;
   private $_two = 2;
   private $_three;

   public function __construct(){
      // three gets no value
   }

   public static function create(){
      return new MyClass();
   }

   public function do_this(){
      $this->_one *= 2;
      return $this;
   }

   public function do_that(){
      $this->_two /= 2;
      return $this;
   }

   public function finish(){
      printf('_one: %d, _two: %d, _three: %d', $this->_one, $this->_two, $this->_three);
   }
}

/*
As @ellisgl mentioned on Twitter, the same effect can be achieved by changing the create function to:
*/

public static function create(){
   return new self; // This line changed
}

/*
After seeing this, I understood that new could take an existing object as an argument. However, I couldn't help but wonder: Does the existing object's constructor get called, returning the existing object, or is the object's type the only portion that is used in the call to new?

So, there was an experiment. I added this method to the MyClass class:
*/

public function set_three($val){
   $this->_three = $val;
}

/*
Changed the create method (again) in the MyClass class to this:
*/

public static function create(){
   global $my_object;
   return new $my_object;
}

/*
... and did this craziness:
*/

$my_object = new MyClass(); // Create an instance of the object
$my_object->set_three(6); // Set three to something (since it's not set in the constructor)
$my_object->finish(); // Show what our variables are

// Now, let's instantiate off of $my_object (instead of the class name), change some stuff, 
// leave three alone, and see if three persists in the newly instantiated object
MyClass::create()->do_this()->do_that()->finish();

/*
... and the result was:

****
_one: 1, _two: 2, _three: 6
_one: 2, _two: 1, _three: 0
****

So, rather uninterestingly, the call to new simply pulls the object's type and creates a brand new instance of it. Uninterestingly, but fortunately, since a lazy call to the constructor only could result in unexpected issues.

This method of instantiating a class is similar to the technique that is used in PHP implementations of the Singleton design pattern.

That's the end of the little experiment. I found it useful to be able to do new self or new object, so I thought I'd share