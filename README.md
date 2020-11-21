##  What is Lazy vs Eager Loading in Laravel?
	in case of lazy loading the releated entities are not loaded automatically with it's parent entity untill they are requested (N+1 Problem)
	For ex: 
		let's say I've a 2 model Author & Books, Author can have many Books & Books belongs to the Author
		in Model file we build this relation by specifying ##hasMany & ##belongsTo methods on the models respectively
		
		lets say i'm loading the Books and there are 100 books and i'm loding Author for related books in lazy loading this will create 1 query for books and 100 querie  to get the Author for each book 
		
		This problem can be solved by Eager loading. Eager loading is way of loading the data from the related entities at once (by using (##with) method  )
		
		
		## in Model create a functions
		
		## In Books Model
			public function author() {
				return $this->belongsTo('App\author');
			}
		
		## in Author Model
			public function books() {
				return $this->hasMany('App\Book');
			}         		   
			
		## Lazy loading : 
		
			$books = Books::all();
			
			foreach ($books as $book) {
				echo $book->author->name; // this is lazy loaded
			}
			
		## Eager Loading
			$books = Books::with('author')->get();
			foreach ($books as $book) {
				echo $book->author->name; // this is eager loaded
			}
## Explain the active record concept in Laravel with a sample snippet?
	## Active Record Implementation is an architectural pattern that stores in-memory object data in relational databases.
	
	$book = new Book;
			
	$book->book_name = 'Laravel';
					
	$book->save();


## What are Closures in Laravel?
	Closure are anonymous functions,  Closures are often used as callback methods and can be used as a parameter in a function.
	function handle(Closure $closure) { $closure(); }

	handle(function(){ echo 'Hello!'; });
	
	
	## Example  
	# Middleware $next parameter is closure mthod once the logged in user condition evaluates to true $next clusre method executes
	  
	public function handle($request, Closure $next, $guard = null)
	{
		if (Auth::guard($guard)->check())
		{
		   return redirect('/home');
		} 

		return $next($request);
	}

## What is a Dependency injection in Laravel	
	Dependency injection injecting class dependecies via constructor or setters methods
	
	lets say we have a User Controller instead of writing all the logic inside User Controller create a UserRepository and write all the business logic and later insert the dependecies into Controller
	
	Example :
	
	## Create a folder Repositories and inside it create a file UserRepository.php
		
		## UserRepository.php
			namespace App\Repositories;
			
			//User Model
			use App\User;
			
			public class {				
				//Function to retrieve all the user
				public function all() {
					return User::all();
				}				
			}
			
	   ## UserController.php
	   
			use App\Repositories\UserRepository;
			class UserController extends Controller {
				protected $user;
				public function __constructor(UserRepository $user)
				{
					$this->user = $user
				}
				public function getUsers() {
					$users = $this->users->all();
					return view("users.index", compact($users));
				}
			}
			
		##  in Web Routes also we can bind dependecies
		
		App.bind("App\ReadConfig\Config", function(){
			return \App\ReadConfig\Config(config(services.User.key));
		});

		$config = App::make("App\ReadConfig\Config");
		var_dump($config);
	
## What is an Observer 
	in Larvel Observer is an object which maintains all the dependents called observers and notifies them of any state changes by calling the observer  method ex(created, creating, saved, saving updated, updating etc)
	
	## Create boot method and inside it call the observer methos on the model object
	protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->author_name = ucwords($model->author_name);
        });
    }
	## another method is using using notifiable and dispatchEvent (protected field) inside model class call the Event. 
	Create a event using php artisan make:event EventName
	Create Event Listener php artisan make:listener EventListner
	
	And Register Event inside EventListner Service Provider

## What are the Default packages
	Cashier (For Billing ), Scout (driver based full text search on eloquent model), Passport (For Authentication), envoy (For Defining Common Tasks usning blade template), Horizon (Dashboard for redis queue)

## What is Route caching?
	It's a way of compiling and storing laravel routes using route:cache whenever there are changes in the route cache must be cleares using route:clear
	
## What are Jobs and Middleware?
   Jobs are the piece of code that will be excuted in backgroud using queue (i've never used it but worked on laravel task scheduler creating cron jobs using task scheduler)

	Middleware are authentication for the routes like if there might be some routes that shoould only be accessd by admin we can create a middle ware to check the user role using command php artisan make:middlleware
	
	
## What are Deferred Providers in laravel
	Config/app.php hold many service provideres some of which are not loaded on every request and are loadded whenever there service is called are known as deferred providers 
	
## What is namespace in Laravel
	namespace is way of grouping classes, interface, functions & constants in one region it provides better structured hierarchie
	in laravel default namespace is App
	
## Explain Joins with an example
	
	## Inner Join Returns only matching records from both the tables 
		
		Ex :
			SELECT author.author_id, author.author_name, books.book_id, books.book_name 
			From author, books 
			Where author.author_id = books.author_id 
			Order By  author_name
			
			## this query returns only matching rows from author and book table
			
	## Left Outer Join   returns all the record from first table and matching records from second table 
		
		Ex :
			SELECT author.author_id, author.author_name, books.book_id, books.book_name 
			From author LEFT OUTER JOIN books ON author.author_id = books.author_id 
			Order By author.author_name
			
			## this query returns all the rows from author table and matching rows from books table
			
	## RIGHT Outer Join   returns all the record from second table and matching records from first table 		
		
		Ex :
			SELECT author.author_id, author.author_name, books.book_id, books.book_name 
			From author RIGHT OUTER JOIN books ON author.author_id = books.author_id 
			Order By author.author_name
			
			## this query returns all the rows from book table and matching rows from the author table for non matched author rows value will be null
			
##  Write a complex query?
		
		SELECT * FROM employee 
		WHERE salary= (SELECT DISTINCT(salary) 
		FROM employee ORDER BY salary LIMIT n,1);		
		
		## returns the second highest salary from the table (In this query the inner select query will return 2 records )
		
		## if we want to retrieve the 3rd highest salary Query will be			
			SELECT * FROM employee 
			WHERE salary= (SELECT DISTINCT(salary) 
			FROM employee ORDER BY salary LIMIT 3,1);	

## What are Accessors and Mutators in Eloquent and why should you use them
	Accessor & Mutators are used to format the eloquent attribute
	
	## let's say model has first_name, user_name, password fields we can create following accessor & mutators in model file
	
		## Accessor 
		public function getFirstNameAttribute($value) {
			return ucfirst($value);
		}
		
		## Mutators 
		public function setUserNameAttribute($value) {
			$this->attributes['user_name'] = strtolower($value);
		}
		
		public function setPassword($value) {
			$this->attributes['password'] = encrypt($value);
		}
		



## 	What is CSRF and JWT token?

	The JWT (JSON WEB TOKEN) is an access token, used for authentication usually stored in cookie.
	
	The CSRF token is used to protect the user from being tricked into sending a forged authenticated request.
	It prevents cross site request forgery the malicious action carried out on behalf of authenticated user
		
	
