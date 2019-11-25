<?php // only copy this line if needed

/**
 * Update an order's status to completed immediately after it's exported
 *
 * @param bool $mark_as_exported whether to mark the order as exported; defaults to true
 * @param \WC_Order $order order being exported
 * @param string $method how the order is exported (ftp, download, etc)
 * @param \WC_Customer_Order_CSV_Export_Handler $handler handler instance
 */
function sv_wc_xml_export_update_exported_order_status( $mark_as_exported, $order, $export_method, $handler ) {

	// uncomment this to avoid setting the order status to complete for a certain export method
	// if ( 'ftp' !== $export_method ) {
	//	 return;
	// }

	$order->update_status( 'completed', 'Order exported to CSV and set to completed.' );
}
add_action( 'wc_customer_order_export_xml_order_exported', 'sv_wc_xml_export_update_exported_order_status', 10, 4 );


// OR


/**
 * Update an order's status to completed upon export only if it's paid
 * Requires WC 2.5+
 *
 * @param bool $mark_as_exported whether to mark the order as exported; defaults to true
 * @param \WC_Order $order order being exported
 */
function sv_wc_xml_export_update_exported_order_status_on_paid( $mark_as_exported, $order ) {

	if ( $order->is_paid() ) {
		$order->update_status( 'completed', 'Order exported to CSV and set to completed.' );
	}

}
add_action( 'wc_customer_order_export_xml_order_exported', 'sv_wc_xml_export_update_exported_order_status_on_paid', 10, 2 );
