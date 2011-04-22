#!/bin/bash

# Keep track of last and current database backups
PREV="${HOME}/backups/$(ls "${HOME}/backups/" | tail -n 1)"
CURR="${HOME}/backups/$(date +%s)_hackathon.out"

# Write database scorereport to file
./scorereport.sh > "$CURR"

# Get counts of records between old and new backup
if [ -f "${PREV}" ]; then
   PREV_COUNT=$(cat "${PREV}" | wc -l)
else
   PREV_COUNT=-1
fi;
CURR_COUNT=$(cat "${CURR}" | wc -l)

# Remove current backup if it's empty
if [ "${CURR_COUNT}" -eq 0 ]; then
   rm ${CURR}
   exit
fi

# Remove current backup if nothing has changed
if [ "${PREV_COUNT}" -eq "${CURR_COUNT}" ]; then
   rm ${CURR}
   exit
fi
