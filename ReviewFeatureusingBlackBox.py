from selenium import webdriver
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.common.keys import Keys
import time

driver = webdriver.Chrome(ChromeDriverManager().install())

driver.get("http://localhost:81/beshvusha/customerLogin.php")#my port is 81 

email=driver.find_element_by_id('customerEmail')
password=driver.find_element_by_id('customerPassword')
login=driver.find_element_by_xpath('/html/body/div/div/div[2]/form/div[3]/button')

email.send_keys("sakibmahmud070@gmail.com")#already registered customer email
password.send_keys("1234")#already registered customer pass
print("Correct username or password is needed otherwise will not connect to next page")
u = driver.current_url
assert u != "http://localhost:81/beshvusha/customerHome.php"
time.sleep(2)
login.click()
time.sleep(2)

shop=driver.find_element_by_xpath('/html/body/nav/div/div/ul/li[3]/a')
driver.execute_script("arguments[0].click();",shop)
time.sleep(4)

viewshop=driver.find_element_by_xpath('/html/body/div/div[2]/div/div[1]/div/button[1]')
driver.execute_script("arguments[0].click();",viewshop)
time.sleep(3)

reviewtext=driver.find_element_by_id('floatingTextarea2')
submitreview=driver.find_element_by_xpath('/html/body/section/div/div/div/div/div[2]/form/div[3]/button')

reviewtext.send_keys("Good Product")
time.sleep(2)

driver.execute_script("arguments[0].click();",submitreview)
time.sleep(4)

viewshop=driver.find_element_by_xpath('/html/body/div/div[2]/div/div[1]/div/button[1]')
driver.execute_script("arguments[0].click();",viewshop)
time.sleep(4)
driver.quit()
