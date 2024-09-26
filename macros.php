<?php

use Jet_Engine\Query_Builder\Manager as Query_Builder_Manager;

class Jet_Engine_Query_Count_Macros extends Jet_Engine_Base_Macros {

	/**
	 * Returns macros tag
	 *
	 * @return string
	 */
	public function macros_tag() {
		return 'jet_engine_query_count';
	}

	/**
	 * Returns macros name
	 *
	 * @return string
	 */
	public function macros_name() {
		return 'Query Count';
	}

	/**
	 * Callback function to return macros value
	 *
	 * @return string
	 */
	public function macros_callback( $args = array() ) {

		$result      = 0;
		$query_id    = ! empty( $args['query_id'] ) ? absint( $args['query_id'] ) : false;
		$column_name = ! empty( $args['column_name'] ) ? sanitize_text_field( $args['column_name'] ) : false;

		if ( ! $query_id || ! $column_name ) {
			return $result;
		}

		$query = Query_Builder_Manager::instance()->get_query_by_id( $query_id );

		if ( ! $query ) {
			return $result;
		}

		foreach ( $query->get_items() as $item ) {
			$item   = (array) $item;
			$value  = isset( $item[ $column_name ] ) ? floatval( $item[ $column_name ] ) : 0;
			$result += $value;
		}

		return $result;
	}

	/**
	 * Optionally return custom macros attributes array
	 *
	 * @return array
	 */
	public function macros_args() {
		return array(
			'query_id' => array(
				'label'   => 'Query',
				'type'    => 'select',
				'options' => function() {
					return Query_Builder_Manager::instance()->get_queries_for_options();
				},
				'default' => '',
			),
			'column_name' => array(
				'label'   => 'Column/property to sum values of',
				'type'    => 'text',
				'default' => '',
			),
			'thousand_sep' => array(
				'label'   => 'Thousand separator',
				'type'    => 'text',
				'default' => ' ',
			),
			'decimal_sep' => array(
				'label'   => 'Decimal point',
				'type'    => 'text',
				'default' => '.',
			),
		);
	}

}
