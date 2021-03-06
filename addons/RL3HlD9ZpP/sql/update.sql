USE [addminpanel]
GO
/****** Object:  Table [dbo].[employees]    Script Date: 12/23/2020 11:50:37 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[employees](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[employee_id] [nvarchar](255) NOT NULL,
	[employee_name] [nvarchar](255) NOT NULL,
	[date] [nvarchar](255) NULL,
	[district] [int] NOT NULL,
	[police_station] [int] NOT NULL,
	[employee_type] [nvarchar](255) NOT NULL,
	[father_name] [nvarchar](255) NULL,
	[mother_name] [nvarchar](255) NULL,
	[maritial_status] [nvarchar](255) NULL,
	[gender] [nvarchar](255) NULL,
	[blood_group] [nvarchar](255) NULL,
	[religion] [nvarchar](255) NULL,
	[mobile_number] [nvarchar](255) NOT NULL,
	[family_mobile_number] [nvarchar](255) NULL,
	[email] [nvarchar](255) NOT NULL,
	[date_of_birth] [nvarchar](255) NULL,
	[nationality] [nvarchar](255) NULL,
	[national_id] [nvarchar](255) NULL,
	[present_address] [nvarchar](255) NULL,
	[permanent_address] [nvarchar](255) NULL,
	[image] [nvarchar](255) NOT NULL,
	[cv] [nvarchar](255) NULL,
	[joining_letter] [nvarchar](255) NULL,
	[present_designation] [nvarchar](255) NOT NULL,
	[working_hour] [nvarchar](255) NOT NULL,
	[present_salary] [nvarchar](255) NOT NULL,
	[previous_company] [nvarchar](255) NULL,
	[previous_company_address] [nvarchar](255) NULL,
	[previous_designation] [nvarchar](255) NULL,
	[previous_salary] [nvarchar](255) NULL,
	[previous_join_date] [nvarchar](255) NULL,
	[previous_end_date] [nvarchar](255) NULL,
	[opening_balance] [nvarchar](255) NOT NULL,
	[balance] [nvarchar](255) NOT NULL,
	[brance_id] [nvarchar](255) NULL,
	[status] [int] NOT NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[employees] ADD  DEFAULT ('0') FOR [opening_balance]
GO
ALTER TABLE [dbo].[employees] ADD  DEFAULT ('0') FOR [balance]
GO
ALTER TABLE [dbo].[employees] ADD  DEFAULT ('1') FOR [status]
GO
