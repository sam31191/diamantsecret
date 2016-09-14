<?php
function mailToAdmin($client, $items, $subtotal, $note) {
	return '<div style="width:100%; text-align:center;"><p><a href="http://www.diamantsecret.com/" title="Diamant Secret" ><img alt="" src="http://localhost/git/diamond_website/src/images/gfx/logo.png" style="height:80px; width:368px" /></a></p>

			<h3><strong>Greetings, Admin</strong></h3>

			<p>'. $client .' has placed a purchase request, details as following</p>

			<table border="1" cellpadding="1" cellspacing="1" style="width:100%">
				<tbody>
					<tr>
						<td>ID</td>
						<td>Type</td>
						<td>Item</td>
						<td>Price</td>
						<td>Discount</td>
						<td>VAT</td>
						<td>Quantity</td>
						<td>Subtotal</td>
						<td>Shape</td>
						<td>Material</td>
						<td>Clarity</td>
						<td>Supplier</td>
						<td>Country</td>
					</tr>'. $items .'
				</tbody>
			</table>

			<h2><strong>Total:  &#0128;'. number_format($subtotal, 2, ".", "") .'</strong></h2>

			<p><strong>Note: '. $note .'</strong></p>

			<hr />
			<p>Copyright &copy; 2016 Diamant Secret. All rights reserved.</p></div>
			';
}
function mailToCustomer($client, $items, $subtotal) {
	return '<div style="width:100%; text-align:center;"><p><a href="http://www.diamantsecret.com/" title="Diamant Secret" ><img alt="" src="http://localhost/git/diamond_website/src/images/gfx/logo.png" style="height:80px; width:368px" /></a></p>

				<h3><strong>Greetings, '. $client .'</strong></h3>

				<p>Your order has been placed, details as following</p>

				<table border="1" cellpadding="1" cellspacing="1" style="width:100%">
					<tbody>
						<tr>
							<td>Type</td>
							<td>Item</td>
							<td>Price</td>
							<td>Discount</td>
							<td>VAT</td>
							<td>Quantity</td>
							<td>Subtotal</td>
							<td>Shape</td>
							<td>Material</td>
							<td>Clarity</td>
						</tr>'. $items .'
					</tbody>
				</table>

				<h2><strong>Total: &#0128;'. number_format($subtotal, 2, ".", "") .'</strong></h2>

				<p>Our sales person will process your order and get in touch with you as soon as possible.</p>

				<hr />
				<p>Copyright &copy; 2016 Diamant Secret. All rights reserved.</p></div>';
}
function mailVerify($customer, $link) {
	return '<div style="width:100%; text-align:center;"><p><a href="http://www.diamantsecret.com/" title="Diamant Secret" ><img alt="" src="http://localhost/git/diamond_website/src/images/gfx/logo.png" style="height:80px; width:368px" /></a></p>

			<p>Greetings, '. $customer .'</p>

			<p>To verify your account, please click the following link:</p>

			<p>'. $link .'</p>

			<hr />
			<p>Copyright &copy; 2016 Diamant Secret. All rights reserved.</p>
			</div>';
}
function mailRecoverPassword($customer, $link) {
	return '<div style="width:100%; text-align:center;"><p><a href="http://www.diamantsecret.com/" title="Diamant Secret" ><img alt="" src="http://localhost/git/diamond_website/src/images/gfx/logo.png" style="height:80px; width:368px" /></a></p>

			<p>Greetings, '. $customer .'</p>

			<p>As per a request made from your account, we have reset your password.</p>

			<p>New Password: '. $link .'</p>

			<p>You can change your password from your Account User Panel.</p>

			<hr />
			<p>Copyright &copy; 2016 Diamant Secret. All rights reserved.</p>
			</div>';
}
?>