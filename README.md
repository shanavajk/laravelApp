##What is Lazy vs Eager Loading in Laravel?
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
##Explain the active record concept in Laravel with a sample snippet?
	## Active Record Implementation is an architectural pattern that stores in-memory object data in relational databases.
	
	$book = new Book;
			
	$book->book_name = 'Laravel';
					
	$book->save();


##What are Closures in Laravel?
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
	