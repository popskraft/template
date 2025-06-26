<?php namespace ProcessWire; ?>

<form id="FormBuilder_contact" name="contact" method="post" action="/form-builder/contact/" enctype="multipart/form-data" data-colspacing="0">

	<div class="Inputfields">

		<!-- email honeypot -->
		<input type="email" class="form-control d-none" id="Inputfield_email_contact" name="email_contact">

		<!-- Your Name -->
		<div class="form-floating mb-2">
			<input class="form-control" id="Inputfield_contact_name" name="contact_name" type="text" maxlength="2048"
				placeholder="Your Name">
			<label class="InputfieldHeader form-label" for="Inputfield_contact_name">Your Name</label>
		</div>

		<div class="row gx-2 row-cols-1 row-cols-md-2">

			<!-- Email  -->
			<div class="col">
				<div class="form-floating mb-2">
					<input id="Inputfield_contact_userpost" name="contact_userpost" class="required form-control" type="email"
						maxlength="250" required="required" placeholder="Email ">
					<label for="Inputfield_contact_userpost">Email </label>
				</div>
			</div>

			<!-- Telephone -->
			<div class="col">
				<div class="form-floating mb-2">
					<input class="form-control" id="Inputfield_contact_phone" name="contact_phone" type="text"
						maxlength="2048" placeholder="Telephone">
					<label for="Inputfield_contact_phone">Telephone</label>
				</div>
			</div>
		</div>

		<!-- Any Comments -->
		<div class="form-floating mb-2">
			<textarea class="required form-control min-vh-15" id="Inputfield_contact_message" name="contact_message" rows="4" required="required" placeholder="Any Comments"></textarea>
			<label for="Inputfield_contact_message">Any Comments</label>
		</div>

		<!-- Скрытая информация о странице отправки -->
		<input class="form-control" id="Inputfield_contact_pagedetails" name="contact_pagedetails" type="hidden" value="Контакты | https://expotec.na4u.ru/kontaktyi/">

		<!-- Send A message -->
		<button class="btn btn-primary btn-lg mt-2" type="submit" name="contact_submit" value="Send A message">Send A message</button>

	</div>

</form>