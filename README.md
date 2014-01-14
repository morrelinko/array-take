array_take()
-----------------

When dealing with arrays, retrieving elements from them can be cumbersome.
Some create an extra array that stores the elements that are expected and do lots
of isset checking on the original array.

For example, if you wanted to retrieve some values from forms, you may do something like this:

	<?php

	if (isset($createData["username"])) {
		$createData["username"] = $_POST["username"];
	}

	if (isset($createData["first_name"])) {
		$createData["first_name"] = $_POST["fname"];
	}

	if (isset($createData["password"])) {
		$createData["password"] = password_hash($_POST["username"], PASSWORD_DEFAULT);
	}

	$someService->createUser($createData);

Imagine if you were to process a very long form!!

Enough already! array_take provides a better way:

	<?php

	$createData = Morrelinko\array_take($_POST, [
		"username",
		"first_name" => "fname",
		"password" => function($value) {
			return password_hash($value, PASSWORD_DEFAULT):
		}
	]);

	$someService->createUser($createData);

### Usage

Retrieve values from a one-dimensional array
Note: if a specified key is not available in the array, it is skipped and not included in the new array.

	<?php

	$user = [
		"name" => "Laju Morrison",
		"hobby" => "None",
		"wedontneedthis" => "somevalue"
	];

	$correctedUser = Morrelinko\array_take($user, ["name", "hobby"]);

	/**
	 * Output:
	 *
	 * 	[
     * 		"name" => "Laju Morrison",
     * 		"hobby" => "None",
     * 	]
	 */

Renaming keys on the new array

	<?php

	$user = [
		"name" => "Laju Morrison",
		"birthday" => "1000/ask/google",
		"wedontneedthis" => "somevalue"
	];

	$user = Morrelinko\array_take($user, ["name" => "user_name", "birthday"]);

	/**
	 * Output:
	 *
	 * 	[
     * 		"user_name" => "Laju Morrison",
     * 		"birthday" => "1000/ask/google",
     * 	]
	 */

Modify value via Anonymous function

	<?php

	$user = [
    		"name" => "Laju Morrison",
    		"password" => "123456"
    	];

    $user = Morrelinko\array_take($user, [
    	"name",
    	"password" => function($value) {
    		return password_hash($value, PASSWORD_BCRYPT):
    	}
    ]);

	/**
	 * Output:
	 *
	 * 	[
	 * 		"name" => "Laju Morrison",
	 * 		"password" => "$2y$12$QjSH496pcT5CEbzjD/vtVeH03tfHKFy36d4J0Ltp3lRtee9HDxY3K",
	 * 	]
	 */


If a two dimensional array is passed to it, the filter is applied to each item in the list

	<?php

	$users = [
		["name" => "Laju Morrison", "status" => "Dreaming..."],
		["name" => "John Doe", "status" => ""],
		["name" => "Mary Alice", "status" => ""]
	];

	$users = Morrelinko\array_take($users, ["name"]);

		/**
    	 * Output:
    	 *
    	 * 	[
    	 * 		["name" => "Laju Morrison"],
    	 * 		["name" => "John Doe"],
    	 *		["name" => "Mary Alice"]
    	 * 	]
    	 */

  Enjoy Coding!!

Supported by http://contactlyapp.com