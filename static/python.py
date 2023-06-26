def add_time(start, duration, day=False):
  (st_hr, rest) = start.split(':')
  st_hr = int(st_hr)
  (st_min, ampm) = rest.split()
  (dur_hr, dur_min) = duration.split(':')
  if ampm == "PM":
    st_hr += 12

  tot_min = int(st_min) + int(dur_min)
  tot_hr = int(st_hr) + int(dur_hr)

  if tot_min >= 60:
    tot_hr += 1
    tot_min -= 60

  if tot_hr >= 24:
    ndays = int(tot_hr / 24)
    rem_hr = int(tot_hr % 24)

  else:
    ndays = 0
    rem_hr = tot_hr

  if rem_hr >=12:
    fin_ampm = "PM"
    rem_hr -= 12
  
  else:
    fin_ampm = "AM"
  
  if rem_hr == 0:
    rem_hr = 12

  if day==False:
    if ndays==0:
      new_time = str(rem_hr) + ":" + str(tot_min).rjust(2,"0") + " " + str(fin_ampm)
    elif ndays==1:
      new_time = str(rem_hr) + ":" + str(tot_min).rjust(2,"0") + " " + str(fin_ampm) + " (next day)"
    elif ndays > 1:
      new_time = str(rem_hr) + ":" + str(tot_min).rjust(2,"0") + " " + str(fin_ampm) + " (" + str(ndays) + " days later)"

  else:
    days=list()
    days.append("Monday")
    days.append("Tuesday")
    days.append("Wednesday") 
    days.append("Tuhrsday") 
    days.append("Friday")
    days.append("Saturday") 
    days.append("Sunday")
    day2 = day[0].upper() + day[1:].lower()
    day_num = days.index(day2)
    day_tot = int((day_num + 1 + ndays)%7 - 1)
    fin_day = days[day_tot]
    
    if ndays==0:
      new_time = str(rem_hr) + ":" + str(tot_min).rjust(2,"0") + " " + str(fin_ampm) + ", " + str(fin_day)
    
    if ndays==1:
      new_time = str(rem_hr) + ":" + str(tot_min).rjust(2,"0") + " " + str(fin_ampm) + ", " + str(fin_day) + " (next day)"
    elif ndays > 1:
      new_time = str(rem_hr) + ":" + str(tot_min).rjust(2,"0") + " " + str(fin_ampm) + ", "+ str(fin_day) +" (" + str(ndays) + " days later)"
    
  return new_time
  
  
  
  

  