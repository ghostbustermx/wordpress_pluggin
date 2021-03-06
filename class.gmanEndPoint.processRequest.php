<?php


class processRequest {


	public static function process($data){
		//print_r($data);
		if( ! empty( $data ) ) {
		?>
	<style>
	#users {
	  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	#users td, #users th {
	  border: 1px solid #ddd;
	  padding: 8px;
	}

	#users tr:nth-child(even){background-color: #f2f2f2;}

	#users tr:hover {background-color: #ddd;}

	#users th {
	  padding-top: 12px;
	  padding-bottom: 12px;
	  text-align: left;
	  background-color: #4CAF50;
	  color: white;
	}
	</style>

        <table border="1" id="users">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>UserName</th>
            <th>Email</th>
        </tr>
        </thead>    
        <tbody>
        <?php
        foreach($data as $obj){
        ?>
        <tr>
			<td><?php echo '<a href="#" onclick="return theApiRequest(' . $obj->id  .');">' . $obj->id ?> </a> </td> 
			<td><?php echo '<a href="#" onclick="return theApiRequest(' . $obj->id  .');">' . $obj->name ?> </a> </td> 
			<td><?php echo '<a href="#" onclick="return theApiRequest(' . $obj->id  .');">' . $obj->username ?> </a> </td> 
			<td><?php echo '<a href="#" onclick="return theApiRequest(' . $obj->id  .');">' . $obj->email ?> </a> </td> 
        </tr>
        <?php   
        }
        ?>
        </tbody>
        </table>

	<br>
	<style>
	#details {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#details td, #details th {
  border: 1px solid #ddd;
  padding: 8px;
}

#details tr:nth-child(even){background-color: #f2f2f2;}

#details tr:hover {background-color: #ddd;}

#details th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4cca50;
  color: white;
} 
</style>
        <table id="details">
				<thead>
					<tr>
						<th>id</th>
						<th>name</th>
						<th>username</th>
						<th>email</th>
						<th>address.street</th>
						<th>address.suite</th>
						<th>address.city</th>
						<th>address.zipcode</th>
						<th>address.geo.lat</th>
						<th>address.geo.lng</th>
						<th>phone</th>
						<th>website</th>
						<th>company.name</th>
					</tr>
				</thead>
				<tbody id="contenido">
					<tr>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
					</tr>
				</tbody>
			</table>

        <script>
        	document.getElementById("details").style.display = "none";
        	var contenido = document.getElementById('contenido');
        	

        	function theApiRequest (param) {

        		var url = 'https://jsonplaceholder.typicode.com/users/'+param;
				var data = {username: 'courseya'};
				fetch(url, {cache: "force-cache"},{
  				method: 'GET', 
  				headers:{
    				'Content-Type': 'application/json'
  				}
				}).then(res => res.json())
				.then( datos => {
					tabla(datos)
				})	 
				;        		
    		}

    		function tabla(datos){

    			var datosJson = JSON.stringify(datos);
    			var x = document.getElementById("details");
    			if (x.style.display === "none") {
        			x.style.display = "block";
    			} else {
        		x.style.display = "block";
    			}

    			for(let valor of datosJson){
    				contenido.innerHTML = '';
    				contenido.innerHTML = `
    				<tr>
						<td>${JSON.stringify(datos.id)}</td>
						<td>${JSON.stringify(datos.name)}</td>
						<td>${JSON.stringify(datos.username)}</td>
						<td>${JSON.stringify(datos.email)}</td>
						<td>${JSON.stringify(datos.address.street)}</td>
						<td>${JSON.stringify(datos.address.suite)}</td>
						<td>${JSON.stringify(datos.address.city)}</td>
						<td>${JSON.stringify(datos.address.zipcode)}</td>
						<td>${JSON.stringify(datos.address.geo.lat)}</td>
						<td>${JSON.stringify(datos.address.geo.lng)}</td>
						<td>${JSON.stringify(datos.phone)}</td>
						<td>${JSON.stringify(datos.website)}</td>
						<td>${JSON.stringify(datos.company.name)}</td>
					</tr>
    			`
    			}
    	}
        </script>	
<?php       
}

	}

}	