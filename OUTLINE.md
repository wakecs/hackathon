# Database Schema

    Users:
     + id
     + name
     + ipaddress
     + passphrase

    Hacks:
     + id
     + hacked_id
     + hack
     + description
     + time

# Site Pages

### Live Stats Page
 - User Scoreboard
 - Hack Statistics
 
### Administration Page
  - Add/Update/Remove Users
  - Mess With Users
    - inject false data to live stats page
    - clean falsely injected data

### Hackathon API
  - recordHack( ipaddress, hack, description, passphrase )
  - getUserScores()

