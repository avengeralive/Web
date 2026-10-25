
	<script>
		function partnerstroka_encode(text) 
			{
			var delimiter = ['-', ','];
			var delimiter_rep = ['n', 'z'];
			var table = ['a', 'B', 'p', 't', 'E', 'w', 'G', 'u', 'q', 'J'];
			var str = '';
			var ok = 0;
			for (var i = 0; i < delimiter.length; i++) 
				{
				if ((text.toLowerCase().indexOf(delimiter[i].toLowerCase()) > -1) && text.length >= 3) 
					{
					ok++;
					break;
					}
				}
			if (ok == 0)
			return false;
			var data = [];
			for (var i = 0; i < text.length; i++) 
				{
				if (text.charAt(i) != ' ' && text.charAt(i) != '')
				data.push(text.charAt(i));
				}
			data.forEach(function (value, key, arr) 
				{
				var ok_key = 0;
				for (var i = 0; i < delimiter.length; i++) 
					{
					if (value == delimiter[i])
					ok_key++;
					}
				if (ok_key == 0)
				data[key] = table[value];
				str += data[key];
				});
			for (var i = 0; i < delimiter.length; i++) 
				{
				str = str.replace(new RegExp(delimiter[i], 'g'), delimiter_rep[i])
				}
			return str;
			}

		function partnerstroka_decode(text, array) 
			{
			var delimiter = ['-', ','];
			var delimiter_rep = ['n', 'z'];
			var table = ['a', 'B', 'p', 't', 'E', 'w', 'G', 'u', 'q', 'J'];
			var ok = 0;
			for (var i = 0; i < delimiter_rep.length; i++) 
				{
				if ((text.toLowerCase().indexOf(delimiter_rep[i].toLowerCase()) > -1) && text.length >= 3) 
					{
					ok++;
					break;
					}
				}
			if (ok == 0)
			return false;
			var data = [];
			for (var i = 0; i < text.length; i++) 
				{
				if (text.charAt(i) != ' ')
				data.push(text.charAt(i));
				}
			table.forEach(function (value, key, arr) 
				{
				text = text.replace(new RegExp(value, 'g'), key);
				});
			if (array == true) 
				{
				for (var i = 0; i < delimiter_rep.length; i++) 
					{
					text = text.replace(new RegExp(delimiter_rep[i], 'g'), delimiter_rep[0]);
					}
				return text.split(delimiter_rep[0]);
				} 
			else 
				{
				for (var i = 0; i < delimiter_rep.length; i++) 
					{
					text = text.replace(new RegExp(delimiter_rep[i], 'g'), delimiter[i]);
					}
				return text;
				}
			}
	</script>
	