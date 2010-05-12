import urllib, hashlib 

# Get input from user
passphrase = hashlib.md5("I ate the dingo's baby.").hexdigest()
address = raw_input("Enter your IP address: ")
hack = raw_input("Enter your hack: ")
description = raw_input("Enter hack description: ")

# Build and send request to server
mParams = 'passphrase=' + passphrase + ':address=' + address + ':hack=' + hack + ':description=' + description
params = urllib.urlencode({ 'method' : 'recordHack', 'params' :  mParams })
f = urllib.urlopen("http://localhost/~chaz/hackathon/api.php", params)
result = f.read()
result = result.split(';')

# Output the result to user
if(int(result[0]) < 0):
  print('\nERROR: ' + result[1])
else:
  print('\nSUCCESS: ' + result[1])

