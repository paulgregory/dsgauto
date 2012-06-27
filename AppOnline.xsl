<?xml version="1.0" encoding="utf-8"?>
<html xsl:version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/xhtml">
  
  <head>
    <title>DSG Auto Contracts Ltd. - Online Application</title>
    <link rel="stylesheet" href="http://www.dsgauto.com/css/AppOnline.css" type="text/css" media="screen"  />
    <link rel="stylesheet" href="http://www.dsgauto.com/css/AppOnlinePrint.css" type="text/css" media="print"  />
  </head>
  
  <body>
      
      <div id="PageContent">
          

          <!--Loop through Application - There'll be only 1 - G.McDowell-->
    	    <xsl:for-each select="Enquiry">            

	    <div id="PageTitle"><xsl:value-of select="Type" /> Online Application - DSG Auto Contracts Ltd.</div>
              
	  <!-- Check for the Presence of Company Data - There will be 0 or 1 -->
	    <xsl:for-each select="BusinessDetails">
		<div class="BusinessInfo">
		 <div class="SectionTitle">Business Information</div>
                  <!--Create Container for all business information -->
                  <div class="SubSection">
					<div class="SubSectionTitle">Business Details</div>
						<div class="ItemTitle">Trading Name :</div> <div class="Item"><xsl:value-of select="TradingName" /></div>
						<div class="ItemTitle">Business Type :</div> <div class="Item"><xsl:value-of select="BusinessType" /></div>
						<div class="ItemTitle">Business Tel :</div> <div class="Item"><xsl:value-of select="TelephoneNo" /></div>
						<div class="ItemTitle">Trading Since :</div> <div class="Item"><xsl:value-of select="TradingSince" /></div>
						<div class="ItemTitle">Nature :</div> <div class="Item"><xsl:value-of select="Nature" /></div>
						<div class="ItemTitle">NoOfEmployees :</div> <div class="Item"><xsl:value-of select="NoOfEmployees" /></div>
						<div class="ItemTitle">Annual Budget :</div> <div class="Item"><xsl:value-of select="AnnualBudget" /></div>
						<div class="ItemTitle">VAT Number :</div> <div class="Item"><xsl:value-of select="VATNumber" /></div>
						<div class="ItemTitle">Company Reg :</div> <div class="Item"><xsl:value-of select="CompanyReg" /></div>
		     <div class="SubSectionTitle">Business Address</div>
                      <div class="ItemTitle">Address  Line 1 :</div><div class="Item"><xsl:value-of select="AddressLine1" /></div>
                      <div class="ItemTitle">Address Line 2 :</div><div class="Item"><xsl:value-of select="AddressLine2" /></div>
                      <div class="ItemTitle">Post Town :</div><div class="Item"><xsl:value-of select="PostTown" /></div>
                      <div class="ItemTitle">Post Code :</div><div class="Item"><xsl:value-of select="PostCode" /></div>
                  <!-- End Subsection DIV -->
                  </div>
	        </div>
	    </xsl:for-each>

            <!--Loop through Applicants - There may be >= 1 - G.McDowell-->  
            <xsl:for-each select="Applicants/ApplicantDetails">
                                
                <!-- Create Container for Each Applicant - There may be >= 1 - G.McDowell-->
                <div class="ApplicantInfo">
                  <div class="SectionTitle"><xsl:value-of select="@ApplicantDesignation" />&#160;<xsl:value-of select="@ApplicantSequence" /> Information</div>
                  
                  <!--Create Container for all applicant personal information - There may be >= 1 for multiple applicants -->
                  <div class="SubSection">
                    <div class="SubSectionTitle">Personal Information</div>
                      <div class="ItemTitle">Title :</div> <div class="Item"><xsl:value-of select="Title" /></div>
                      <div class="ItemTitle">Forename :</div> <div class="Item"><xsl:value-of select="Forename" /></div>
                      <div class="ItemTitle">Middlename :</div> <div class="Item"><xsl:value-of select="Middlename" /></div>
                      <div class="ItemTitle">Surname :</div> <div class="Item"><xsl:value-of select="Surname" /></div>
                      <div class="ItemTitle">DOB :</div> <div class="Item"><xsl:value-of select="DOB" /></div>
                      <div class="ItemTitle">Marital Status :</div><div class="Item"><xsl:value-of select="MaritalStatus" /></div>
                  <!-- End Subsection DIV -->
                  </div>

                  <!--Create Container for all applicant contact details - There may be >= 1 for multiple applicants -->
                  <div class="SubSection">
                    <div class="SubSectionTitle">Contact Information</div>
                      <div class="ItemTitle">Telephone Number:</div><div class="Item"><xsl:value-of select="Telephone" />  </div>
                      <div class="ItemTitle">Mobile Number:</div><div class="Item"><xsl:value-of select="Mobile" /> </div>
                      <div class="ItemTitle">Email:</div><div class="Item"><xsl:value-of select="Email" /> </div>
                  <!-- End Subsection DIV -->  
                  </div>
                 
                </div>
              
                <div class="ApplicantAddresses">
                  <div class="SectionTitle"><xsl:value-of select="@ApplicantDesignation" />&#160;<xsl:value-of select="@ApplicantSequence" /> Addresses</div>                                
                  <div class="SubSection">
                    <!--<div class="SubSectionTitle">Addresses</div>-->
                    <!--Loop through this applicant's addresses - could be >= 1 - G.McDowell-->
                    <xsl:for-each select="Addresses/AddressDetails">		
                      <div class="Address">
                        <div class="SubSubSectionTitle">Address <xsl:value-of select="@AddressSequence" /></div>
                        <div class="ItemTitle">Address  Line 1 :</div><div class="Item"><xsl:value-of select="AddressLine1" /></div>
                        <div class="ItemTitle">Address Line 2 :</div><div class="Item"><xsl:value-of select="AddressLine2" /></div>
                        <div class="ItemTitle">Post Town :</div><div class="Item"><xsl:value-of select="PostTown" /></div>
                        <div class="ItemTitle">Post Code :</div><div class="Item"><xsl:value-of select="PostCode" /></div>
                        <div class="ItemTitle">Accommodation Type :</div><div class="Item"><xsl:value-of select="AccommodationType" /></div>
                        <div class="ItemTitle">Years at Address :</div><div class="Item"><xsl:value-of select="YearsAtAddress" /></div>
                        <div class="ItemTitle">Months at Address :</div><div class="Item"><xsl:value-of select="MonthsAtAddress" /></div>
		                  </div>                  
                    </xsl:for-each>
                  <!-- End Subsection DIV -->
                  </div>
                </div>
              
              
		 <xsl:for-each select="Employments">
			  <div class="ApplicantEmployments">	
                  <div class="SectionTitle"><xsl:value-of select="/Enquiry/Applicants/ApplicantDetails/@ApplicantDesignation" />&#160;<xsl:value-of select="/Enquiry/Applicants/ApplicantDetails/@ApplicantSequence" /> Employments</div>                  
                  <!--Create Container for all applicant employments - There may be >= 1 for multiple applicants -->
                  <div class="SubSection">
                    <!--<div class="SubSectionTitle">Employments</div>-->
                    <!--Loop through this applicant's employments - could be >= 1 - G.McDowell-->
                    <xsl:for-each select="EmploymentDetails">
                      <div class="Employment">
                        <div class="SubSubSectionTitle">Employer <xsl:value-of select="@EmploymentSequence" /> </div>				     
                        <div class="ItemTitle">Employer Name :</div><div class="Item"><xsl:value-of select="EmployerName" /> </div>
                        <div class="ItemTitle">Occupation : </div><div class="Item"><xsl:value-of select="Occupation" />  </div>
			<div class="ItemTitle">Occupation Basis : </div><div class="Item"><xsl:value-of select="OccupationBasis" />  </div>
                        <div class="ItemTitle">Address Line 1 : </div><div class="Item"><xsl:value-of select="AddressLine1" />   </div>
                        <div class="ItemTitle">Address Line 2 :</div><div class="Item"><xsl:value-of select="AddressLine2" />    </div>
                        <div class="ItemTitle">Post Town : </div><div class="Item"><xsl:value-of select="PostTown" />   </div>
                        <div class="ItemTitle">Post Code : </div><div class="Item"><xsl:value-of select="PostCode" />    </div>
			<div class="ItemTitle">Telephone No : </div><div class="Item"><xsl:value-of select="TelephoneNo" />    </div>
                        <div class="ItemTitle">Years Employed : </div><div class="Item"><xsl:value-of select="YearsEmployed" /> </div>
                        <div class="ItemTitle">Months Employed : </div><div class="Item"><xsl:value-of select="MonthsEmployed" /> </div>
                      </div> 	
                    </xsl:for-each>
                  <!-- End Subsection DIV -->
                  </div> 
									 </div>
		 </xsl:for-each>
               

            <!-- End Applicants/ApplicantData for-each-->  
            </xsl:for-each>    
                      
            
	    <!-- Vehicle Section -->	    
	    <xsl:for-each select="VehicleDetails"> 
		<div class="Vehicle">			
  		    <div class="SectionTitle">Vehicle Information</div>
		    <div class="SubSection">
				<div class="ItemTitle">Manufacturer : </div><div class="Item"><xsl:value-of select="Brand" /> </div>
	                        <div class="ItemTitle">Model : </div><div class="Item"><xsl:value-of select="Model" />  </div>
				<div class="ItemTitle">Derivative : </div><div class="Item"><xsl:value-of select="Derivative" />  </div>
	                        <div class="ItemTitle">Optional Extras : </div><div class="Item"><xsl:value-of select="Options" />   </div>
		    </div>	
	  	</div>
	    </xsl:for-each>
	    

	    <!-- Finance Section -->	    
	    <xsl:for-each select="FinanceDetails"> 
		<div class="Finance">			
  		    <div class="SectionTitle">Finance Information</div>
		    <div class="SubSection">
				<div class="ItemTitle">Finance Type : </div><div class="Item"><xsl:value-of select="FinanceType" /> </div>
	                        <div class="ItemTitle">Term : </div><div class="Item"><xsl:value-of select="Term" />  </div>
				<div class="ItemTitle">Maintenance Package? : </div><div class="Item"><xsl:value-of select="MaintenancePackage" />  </div>
	                        <div class="ItemTitle">Mileage Per Year : </div><div class="Item"><xsl:value-of select="MileagePerYear" />   </div>
	                        <div class="ItemTitle">Monthly Budget : </div><div class="Item"><xsl:value-of select="MonthlyBudget" />   </div>
	                        <div class="ItemTitle">Bad Credit History? : </div><div class="Item"><xsl:value-of select="BadCreditHistory" />   </div>
	                        <div class="ItemTitle">Credit Declined in the Past? : </div><div class="Item"><xsl:value-of select="CreditDeclined" />   </div>
		    </div>	
	  	</div>
	    </xsl:for-each>

	    <!-- Notes Section -->	    
	    <xsl:for-each select="AdditionalInformation"> 
		<div class="AdditionalInfo">			
  		    <div class="SectionTitle">Additional Information</div>
		    <div class="SubSection">
				<div class="ItemTitle">Supporting Notes : </div><div class="Item"><xsl:value-of select="Notes" /> </div>
		    </div>	
	  	</div>
	    </xsl:for-each>


              <!--Create Bank Section-->
              <div class="Bank">
                <div class="SectionTitle">Bank Information</div>
                  <div class="SubSection">
                    <xsl:for-each select="BankDetails">
                      <div class="ItemTitle">Bank Name : </div><div class="Item"><xsl:value-of select="BankName" /></div> 
                      <div class="ItemTitle">Sort Code : </div><div class="Item"><xsl:value-of select="SortCode" /></div>
                      <div class="ItemTitle">Account No : </div><div class="Item"><xsl:value-of select="AccountNo" /></div>
                      <div class="ItemTitle">Years at Bank : </div><div class="Item"><xsl:value-of select="YearsAtBank" /></div>
                    </xsl:for-each>
                  </div>
              </div>

            <!-- End OnlineApplicationData for-each -->
            </xsl:for-each>
      
          <!-- End PageContent DIV-->
          </div>
    
  </body>
  
</html>