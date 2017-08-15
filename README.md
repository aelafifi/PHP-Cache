# PHP-Cache
PHP class to handle cache for dynamically generated assets files

## How to use

#### example (1): Check cache when REQUEST_URI is unique for each result
```html
<!-- example1.html -->
<img src="generate-barcode.php?text=some_text" />
```

```php
/* generate-barcode.php */

require_once '/path/to/Cache.php';
Cache::check();

// do some process and return the image file
```

#### example (2): Check cache when the same REQUEST_URI may return different result
```html
<!-- example2.html -->
<img src="profile-picture.php?user_id=1234" />
```

```php
/* profile-picture.php */

$PREFIX = $_SERVER['REQUEST_URI'] . '#';

$user = someCodeToGetUserRecordFromDB($_['user_id']);

require_once '/path/to/Cache.php';
Cache::check($PREFIX . $user->profile_picture);

// and complete your process here
readfile('/path/to/images/' . $user->profile_picture);
```

## To-Do List
- [ ] Check file mtime
- [ ] add parameter for auto adding the prefix

## License and Acknowledgements

Copyright 2017 Ahmed S. El-Afifi <ahmed.s.elafifi@gmail.com>

Licensed under the MIT License
