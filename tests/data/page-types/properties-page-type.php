<?php

class Properties_Page_Type extends Papi_Page_Type {

	/**
	 * Define our Page Type meta data.
	 *
	 * @return array
	 */
	public function page_type() {
		return [
			'name'        => 'Properties page type',
			'description' => 'This is a properties page',
			'template'    => 'pages/properties-page.php'
		];
	}

	/**
	 * Define our properties.
	 */
	public function register() {

		$this->box( 'boxes/properties.php' );

		$this->box( 'Other', [
			// Test items converting.
			papi_property( [
				'type'     => 'flexible',
				'title'    => 'Flexible test',
				'slug'     => 'flexible_test_other',
				'settings' => [
					'items' => [
						'twitter' => [
							'title' => 'Twitter',
							'items' => [
								papi_property( [
									'type'  => 'string',
									'title' => 'Twitter name',
									'slug'  => 'twitter_name'
								] )
							]
						],
						'posts' => [
							'title' => 'Posts',
							'items' => [
								papi_property( [
									'type'  => 'post',
									'title' => 'Post one',
									'slug'  => 'post_one'
								] ),
								papi_property( [
									'type'  => 'post',
									'title' => 'Post two',
									'slug'  => 'post_two'
								] )
							]
						],
						'list' => [
							'title' => 'List',
							'items' => [
								[
									'type'     => 'repeater',
									'title'    => 'Repeater test',
									'slug'     => 'repeater_test_other',
									'settings' => [
										'items' => [
											[
												'type'  => 'string',
												'title' => 'Book name',
												'slug'  => 'book_name'
											],
											[
												'type'  => 'bool',
												'title' => 'Is open?',
												'slug'  => 'is_open'
											]
										]
									]
								]
							]
						],
						'list2' => [
							'title' => 'List 2',
							'items' => [
								papi_property( [
									'type'     => 'repeater',
									'title'    => 'Repeater test 2',
									'slug'     => 'repeater_test_other_2',
									'settings' => [
										'items' => [
											[
												'type'  => 'string',
												'title' => 'Book name',
												'slug'  => 'book_name'
											],
											[
												'type'  => 'bool',
												'title' => 'Is open?',
												'slug'  => 'is_open'
											]
										]
									]
								] )
							]
						]
					]
				]
			] )
		] );

	}
}
