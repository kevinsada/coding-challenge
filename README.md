## 1- Clone project
## 2- cd into project
## 3- composer install

## Ready to go.

The 2 commands are stored inside `app/Console/Commands` folder. <br>
* The first command `Index.php` is executed by writing the following command: 
`php artisan create:file {doc_id} {tokens}`. The doc id is the index of the 
file and the second parameter will be token. The command can accept as many tokens 
as desired separated by a space. Index must be positive number & tokens must be alphanumeric
 otherwise there will be thrown an error. After hitting `enter` a file will be added inside 
`storage/app` folder. <br>
# Example: `php artisan create:file 1 Apple Orange Banana` 

* The second command Query.php is executed by writing the following command: 
`php artisan search:query {token}`. The token parameter is the token which we will be searching for.
If no results are found there will be printed: `query error: no results found`.
If results are found there will be printed `doc-id` associated with the index(es).
# Example: `php artisan search:query apple`
* Output: `doc-id 1`
