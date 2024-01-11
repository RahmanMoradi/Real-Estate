
## Futures


-  Spatie Query Builder For better Structure
- Spatie Role Permission
- Spatie Tags
- Spatie MediaLibrary (Not Completed)
- Laravel-Actions
- Repository Pattern


## how to make queries?


- filteer[filter-name]=value or true
- how to get count of a maked query? -> add &count=true to the end of the url


## Estate available filters

- has_warehouse (true)
- type (rent or mortgage)
- city (name of the city)
- meterage (it takes a $min and a $max variable(two parameters) and gives you the estates which their meterage are between $min and $max)
- priceBigger (takes a $min parameter and return the estates where their price are bigger than $min)
- only_trashed (gives you the soft-deleted estates)
- has_comment (true)
- commentsBigger (takes a $min parameter and return the estates which has atleast $min comments)
- tag ($tag return the estates which has the specified tag)
